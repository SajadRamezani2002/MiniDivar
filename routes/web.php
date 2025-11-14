<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdController;
use App\Http\Controllers\UserController;

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
