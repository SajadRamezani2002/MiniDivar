<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Ad;
use App\Models\User;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    /**
     * نمایش داشبورد کاربر
     */
    public function index()
    {
        $user = Auth::user();

        // آگهی‌های کاربر (بدون Pagination)
        $ads = Ad::where('user_id', $user->id)->latest()->get();

        // آمار کاربر
        $stats = [
            'total' => $ads->count(),
            'pending' => $ads->where('status', 'pending')->count(),
            'active' => $ads->where('status', 'active')->count(),
            'rejected' => $ads->where('status', 'rejected')->count(),
        ];

        // لیست کاربران برای نمایش در بخش مدیریت کاربران (Pagination)
        // فقط در صورتی که کاربر ادمین باشه نمایش داده می‌شود
        $users = null;
        if ($user->role === 'admin') {
            $users = User::paginate(10); // 10 کاربر در هر صفحه
        }

        return view('dashboard.user', compact('user', 'ads', 'stats', 'users'));
    }
}
