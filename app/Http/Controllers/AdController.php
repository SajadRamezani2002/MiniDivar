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
        $ads = Ad::with('category', 'user')->latest()->paginate(10);
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
            'city' => 'required',
            'category_id' => 'required|exists:categories,id',
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
            // اگر کاربر لاگین هست از id استفاده کن، در غیر این صورت مقدار موقت (برای توسعه) 1 قرار میده
            'user_id' => Auth::check() ? Auth::id() : 1,
            'status' => 'pending',
        ]);

        return redirect()->route('ads.index')->with('success', 'آگهی با موفقیت ثبت شد و در انتظار تأیید است.');
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
