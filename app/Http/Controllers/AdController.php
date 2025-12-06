<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class AdController extends Controller
{
    // نمایش تمام آگهی‌ها (صفحه اصلی)

    public function index(Request $request)
    {
        $query = Ad::with('category', 'user')->where('status', 'active');

        // جستجو در عنوان و توضیحات آگهی
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'LIKE', "%{$request->search}%")
                ->orWhere('description', 'LIKE', "%{$request->search}%");
            });
        }

        // فیلتر بر اساس دسته‌بندی (شامل خود دسته مادر و تمام فرزندان)
        if ($request->category_id) {
            $descendantIds = $this->getDescendantCategoryIds($request->category_id);
            // این خط کلیدی است: ID دسته مادر را به ابتدای آرایه اضافه می‌کنیم
            $allIds = collect([$request->category_id])->merge($descendantIds);
            $query->whereIn('category_id', $allIds);
        }

        $ads = $query->latest()->paginate(12);
        $categories = Category::all();

        return view('ads.index', compact('ads', 'categories'));
    }

    // نمایش فرم ایجاد آگهی جدید
    public function create()
    {
        $categories = Category::all();
        return view('ads.create', compact('categories'));
    }

    /**
     * ذخیره آگهی جدید در دیتابیس.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // 1. اصلاح داده‌های ورودی (تبدیل JSON به آرایه)
        $request->merge([
            'cropped_images_data' => json_decode($request->input('cropped_images_data'), true),
        ]);

        // 2. اعتبارسنجی اطلاعات ورودی از فرم
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:70',
            'description' => 'required|min:20',
            'price' => 'required|numeric',
            'city' => 'required|min:3',
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'nullable|image|mimes:jpeg,jpg,png|max:3072',
            'images' => 'nullable|array|max:4',
            'cropped_images_data' => 'nullable|array',
        ], [
            'title.required' => 'عنوان آگهی الزامی است.',
            'title.max' => 'عنوان نباید بیشتر از 70 کاراکتر باشد.',
            'description.required' => 'توضیحات الزامی است.',
            'description.min' => 'توضیحات باید حداقل 20 کاراکتر باشد.',
            'price.required' => 'قیمت آگهی الزامی است.',
            'price.numeric' => 'قیمت باید یک عدد معتبر باشد.',
            'city.required' => 'شهر الزامی است.',
            'category_id.required' => 'دسته‌بندی الزامی است.',
            'category_id.exists' => 'دسته‌بندی انتخاب شده معتبر نیست.',
            'images.*.image' => 'فایل باید یک تصویر باشد.',
            'images.*.mimes' => 'تصاویر باید با فرمت jpg یا png باشند.',
            'images.*.max' => 'حجم هر تصویر نباید بیشتر از 3 مگابایت باشد.',
            'images.max' => 'حداکثر 4 تصویر می‌توانید آپلود کنید.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // 3. ایجاد رکورد اصلی آگهی در دیتابیس
        $ad = Ad::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'city' => $request->city,
            'category_id' => $request->category_id,
            'user_id' => Auth::check() ? Auth::id() : 1,
            'status' => 'pending',
        ]);

        // 4. پردازش و ذخیره‌سازی تصاویر
        $croppedData = $request->input('cropped_images_data', []);
        $originalFiles = $request->file('images', []);

        if (!empty($originalFiles)) {
            // ساخت یک نمونه از مدیر تصویر با درایور GD
            $manager = new ImageManager(new Driver());

            foreach ($originalFiles as $index => $file) {
                try {
                    $imagePath = null;

                    if (isset($croppedData[$index]) && !empty($croppedData[$index])) {
                        // حالت اول: پردازش تصویر برش‌خورده (Base64)
                        $image = $manager->read($croppedData[$index]);
                        $filename = 'ads/' . uniqid('ad_', true) . '.jpg';
                        Storage::disk('public')->put($filename, $image->toJpeg(90));
                        $imagePath = $filename;

                    } else {
                        // حالت دوم: پردازش تصویر اصلی آپلود شده
                        $image = $manager->read($file->path());
                        $image->cover(800, 600);
                        $filename = 'ads/' . uniqid('ad_', true) . '.jpg';
                        Storage::disk('public')->put($filename, $image->toJpeg(90));
                        $imagePath = $filename;
                    }

                    if ($imagePath) {
                        $ad->images()->create(['file_path' => $imagePath]);
                    }

                } catch (\Exception $e) {
                    \Log::error("Error processing image index {$index} for ad {$ad->id}: " . $e->getMessage());
                }
            }
        }

        // 5. هدایت کاربر به داشبورد با پیام موفقیت
        return redirect()->route('dashboard')->with('success', 'آگهی شما با موفقیت ثبت شد و در انتظار تأیید است.');
    }

    /**
     * نمایش فرم ویرایش آگهی
     */
    public function edit($id)
    {
        $ad = Ad::findOrFail($id);
        $categories = Category::all();

        // بررسی می‌کند که آیا کاربر فعلی صاحب آگهی است یا خیر
        if ($ad->user_id !== auth()->id()) {
            abort(403); // اگر صاحب آگهی نبود، خطای دسترسی ممنوع نمایش بده
        }

        return view('ads.edit', compact('ad', 'categories'));
    }

    /**
     * به‌روزرسانی اطلاعات آگهی
     */
    public function update(Request $request, $id)
    {
        $ad = Ad::findOrFail($id);

        // بررسی می‌کند که آیا کاربر فعلی صاحب آگهی است یا خیر
        if ($ad->user_id !== auth()->id()) {
            abort(403); // اگر صاحب آگهی نبود، خطای دسترسی ممنوع نمایش بده
        }

        // اعتبارسنجی اطلاعات جدید
        $validatedData = $request->validate([
            'title' => 'required|max:70',
            'description' => 'required|min:20',
            'price' => 'required|numeric',
            'city' => 'required|min:3',
            'category_id' => 'required|exists:categories,id',
        ]);

        $ad->update($validatedData);

        return redirect()->route('dashboard')->with('success', 'آگهی شما با موفقیت ویرایش شد.');
    }

    // نمایش جزئیات آگهی
    public function show(Ad $ad)
    {
        // این شرط باعث 404 شدن آگهی‌های غیرفعال می‌شود
        if ($ad->status !== 'active') {
            abort(404);
        }

        // این کد را هم برای تست اضافه کنید تا ببینید آگهی‌های مشابه دریافت می‌شوند یا نه
        $similarAds = Ad::where('category_id', $ad->category_id)
                        ->where('id', '!=', $ad->id)
                        ->where('status', 'active')
                        ->inRandomOrder()
                        ->take(4)
                        ->get();

        if ($similarAds->count() < 4) {
            $remainingCount = 4 - $similarAds->count();
            $otherAds = Ad::where('id', '!=', $ad->id)
                        ->where('status', 'active')
                        ->whereNotIn('id', $similarAds->pluck('id'))
                        ->inRandomOrder()
                        ->take($remainingCount)
                        ->get();
            $similarAds = $similarAds->merge($otherAds);
        }

        return view('ads.show', compact('ad', 'similarAds'));
    }

    // حذف آگهی
    public function destroy($id)
    {
        $ad = Ad::findOrFail($id);
        $ad->delete();

        return redirect()->route('ads.index')->with('success', 'آگهی حذف شد.');
    }


    // نمایش آگهی‌های کاربر لاگین کرده
    public function myAds(Request $request)
    {
        $query = Ad::with('category', 'user')->where('user_id', Auth::id());

        // جستجو در عنوان و توضیحات آگهی
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'LIKE', "%{$request->search}%")
                ->orWhere('description', 'LIKE', "%{$request->search}%");
            });
        }

        // فیلتر بر اساس دسته‌بندی (شامل خود دسته مادر و تمام فرزندان)
        if ($request->category_id) {
            $descendantIds = $this->getDescendantCategoryIds($request->category_id);
            // این خط کلیدی است: ID دسته مادر را به ابتدای آرایه اضافه می‌کنیم
            $allIds = collect([$request->category_id])->merge($descendantIds);
            $query->whereIn('category_id', $allIds);
        }

        $ads = $query->latest()->paginate(12);
        $categories = Category::all();

        return view('ads.index', compact('ads', 'categories'))->with('isMyAdsPage', true);
    }

    /**
     * تمام IDهای دسته‌بندی‌های فرزند یک دسته مادر را برمی‌گرداند.
     *
     * @param int $parentId
     * @return \Illuminate\Support\Collection
     */
    private function getDescendantCategoryIds($parentId)
    {
        $children = Category::where('parent_id', $parentId)->get();
        $ids = $children->pluck('id');

        foreach ($children as $child) {
            // برای هر فرزند، متد را دوباره برای فرزندان خودش فراخوانی می‌کنیم
            $ids = $ids->merge($this->getDescendantCategoryIds($child->id));
        }

        return $ids;
    }

}
