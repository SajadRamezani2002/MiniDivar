<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ad;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // صفحه اصلی داشبورد ادمین
    public function index()
    {
        $totalAds = Ad::count();
        $pendingAds = Ad::where('status', 'pending')->count();
        $activeAds = Ad::where('status', 'active')->count();
        $rejectedAds = Ad::where('status', 'rejected')->count();
        $usersCount = User::count();
        $categories = Category::count();

        $recentAds = Ad::latest()->take(5)->get();

        return view('dashboard.admin', compact(
            'totalAds', 'pendingAds', 'activeAds', 'rejectedAds', 'usersCount', 'categories', 'recentAds'
        ));
    }

    // لیست آگهی‌ها
    public function ads()
    {
        $ads = Ad::with('user', 'category')->latest()->paginate(10);
        return view('admin.ads', compact('ads'));
    }

    // تأیید آگهی
    public function approveAd($id)
    {
        $ad = Ad::findOrFail($id);
        $ad->status = 'active';
        $ad->save();

        return back()->with('success', 'آگهی با موفقیت تأیید شد.');
    }

    // رد آگهی
    public function rejectAd($id)
    {
        $ad = Ad::findOrFail($id);
        $ad->status = 'rejected';
        $ad->save();

        return back()->with('error', 'آگهی رد شد.');
    }

    // حذف آگهی
    public function deleteAd($id)
    {
        $ad = Ad::findOrFail($id);
        $ad->delete();

        return back()->with('success', 'آگهی حذف شد.');
    }

    // مدیریت کاربران
    public function users()
    {
        $users = User::paginate(10);
        return view('admin.users', compact('users'));
    }

    // فعال یا غیرفعال کردن کاربر
    public function toggleUser($id)
    {
        $user = User::findOrFail($id);
        $user->role = $user->role === 'banned' ? 'user' : 'banned';
        $user->save();

        return back()->with('success', 'وضعیت کاربر به‌روزرسانی شد.');
    }
}
