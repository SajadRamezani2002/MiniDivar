<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema; // برای تنظیمات دیتابیس
use Carbon\Carbon; // این خط را اضافه کنید

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // این خط را اضافه کنید
        Carbon::setLocale('fa');

        // این خط برای صفحه‌بندی با استایل بوت‌استرپ است
        Paginator::useBootstrap();
    }
}
