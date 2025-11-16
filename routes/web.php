<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Auth;


Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('home', function () {
    return view('index');
});


Route::get('/', [AdController::class, 'index'])->name('ads.index');
Route::get('/ads/create', [AdController::class, 'create'])->name('ads.create');
Route::post('/ads', [AdController::class, 'store'])->name('ads.store');
Route::get('/ads/{id}', [AdController::class, 'show'])->name('ads.show');
Route::delete('/ads/{id}', [AdController::class, 'destroy'])->name('ads.destroy');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// داشبورد کاربر
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
});

// داشبورد ادمین
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['auth', 'isAdmin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/ads', [AdminController::class, 'ads'])->name('admin.ads');
    Route::post('/ads/{id}/approve', [AdminController::class, 'approveAd'])->name('admin.ads.approve');
    Route::post('/ads/{id}/reject', [AdminController::class, 'rejectAd'])->name('admin.ads.reject');
    Route::delete('/ads/{id}', [AdminController::class, 'deleteAd'])->name('admin.ads.delete');

    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/users/{id}/toggle', [AdminController::class, 'toggleUser'])->name('admin.users.toggle');
});
Route::get('/redirect-after-login', function () {
    if (Auth::check() && Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('dashboard');
});
