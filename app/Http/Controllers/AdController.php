<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdController extends Controller
{
    // نمایش تمام آگهی‌ها (صفحه اصلی)
    public function index()
    {
        // فقط آگهی‌های تایید شده (active)
        $ads = Ad::with('category', 'user')
                ->where('status', 'active')
                ->latest()
                ->paginate(10);

        return view('ads.index', compact('ads'));
    }

    // نمایش فرم ایجاد آگهی جدید
    public function create()
    {
        $categories = Category::all();
        return view('ads.create', compact('categories'));
    }

    // ذخیره آگهی جدید
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:70',
            'description' => 'required|min:20',
            'price' => 'required|numeric',
            'city' => 'required|min:3',
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'nullable|image|mimes:jpeg,jpg,png|max:3072',
            'images' => 'nullable|array|max:4',
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

        $ad = Ad::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'city' => $request->city,
            'category_id' => $request->category_id,
            'user_id' => Auth::check() ? Auth::id() : 1,
            'status' => 'pending',
        ]);

        // آپلود تصاویر
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('ads', 'public');
                $ad->images()->create(['file_path' => $path]);
            }
        }

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

    public function myAds()
    {
        $ads = Ad::with('category', 'user')
                ->where('user_id', Auth::id()) // فقط آگهی‌های کاربر فعلی
                ->latest()
                ->paginate(10);

        // می‌توانیم از همان ویو ads.index استفاده کنیم
        // و با یک پرچم (flag) به آن بگوییم که این صفحه "آگهی‌های من" است
        return view('ads.index', compact('ads'))->with('isMyAdsPage', true);
    }

}
