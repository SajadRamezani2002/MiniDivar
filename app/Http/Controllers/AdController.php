<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- Facade برای auth
use Illuminate\Support\Facades\Validator;

class AdController extends Controller
{
    // نمایش تمام آگهی‌ها (صفحه اصلی)
    public function index()
    {
        $ads = Ad::with('category', 'user')->where('status', 'active')->latest()->paginate(10);
        return view('ads.index', compact('ads'));

    }

    // نمایش فرم ایجاد آگهی جدید
    public function create()
    {
        $categories = Category::all();
        return view('ads.create', compact('categories'));
    }

    // ذخیره آگهی جدید
    // ذخیره آگهی جدید با تصاویر
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
        'description.min' => 'توضیحات باید حداقل 50 کاراکتر باشد.',
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
                $path = $file->store('ads', 'public'); // مسیر: storage/app/public/ads
                $ad->images()->create(['path' => $path]);
            }
        }

        return redirect()->route('dashboard')->with('success', 'آگهی شما با موفقیت ثبت شد و در انتظار تأیید است.');
    }


    // نمایش جزئیات آگهی
    public function show($id)
    {
        $ad = Ad::with('category', 'user', 'images')->findOrFail($id);
        return view('ads.show', compact('ad'));
    }

    // حذف آگهی (فقط برای تست فعلاً)
    public function destroy($id)
    {
        $ad = Ad::findOrFail($id);
        $ad->delete();

        return redirect()->route('ads.index')->with('success', 'آگهی حذف شد.');
    }
}
