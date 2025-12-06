<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| مسیرهای عمومی
|--------------------------------------------------------------------------
*/

Route::get('/', [AdController::class, 'index'])->name('ads.index');
Route::get('/ads/create', [AdController::class, 'create'])->name('ads.create');
Route::post('/ads', [AdController::class, 'store'])->name('ads.store');
Route::get('/ads/{ad}', [AdController::class, 'show'])->name('ads.show');
Route::delete('/ads/{id}', [AdController::class, 'destroy'])->name('ads.destroy');

Route::get('/welcome', fn() => view('welcome'));
Route::get('/home', fn() => view('index'));
Route::get('/my-ads', [AdController::class, 'myAds'])->name('my.ads')->middleware('auth');
/*
|--------------------------------------------------------------------------
| مسیرهای کاربران عادی (نیاز به ورود دارد)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    // --- مسیرهای ویرایش آگهی را اینجا اضافه کنید ---
    Route::get('/ads/{ad}/edit', [AdController::class, 'edit'])->name('ads.edit');
    Route::put('/ads/{ad}', [AdController::class, 'update'])->name('ads.update');
});

/*
|--------------------------------------------------------------------------
| مسیرهای ادمین
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'isAdmin'])->prefix('admin')->group(function () {
    // داشبورد
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // مدیریت آگهی‌ها
    Route::get('/ads', [AdminController::class, 'ads'])->name('admin.ads');
    Route::post('/ads/{id}/approve', [AdminController::class, 'approveAd'])->name('admin.ads.approve');
    Route::post('/ads/{id}/reject', [AdminController::class, 'rejectAd'])->name('admin.ads.reject');
    Route::delete('/ads/{id}', [AdminController::class, 'deleteAd'])->name('admin.ads.delete');

    // مدیریت کاربران
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/users/{id}/toggle', [AdminController::class, 'toggleUser'])->name('admin.users.toggle');
    Route::post('/users/{id}/toggle-role', [AdminController::class, 'toggleUserRole'])->name('admin.users.toggleRole');
});


/*
|--------------------------------------------------------------------------
| ریدایرکت بعد از لاگین
|--------------------------------------------------------------------------
*/
Route::get('/redirect-after-login', function () {
    if (Auth::check() && Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('dashboard');
});
