@extends('layouts.app')
@section('title', 'ثبت‌نام')

@push('styles')
<style>
    /* استایل‌های کلی برای صفحه ثبت‌نام */
    body, html {
        height: 100%;
        background-color: #f8f9fa;
    }

    .register-container {
        min-height: 100vh;
        position: relative;
    }

    /* استایل سمت راست (تصویر) */
    .register-image-side {
        background: url('https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1973&q=80') no-repeat center center;
        background-size: cover;
        position: relative;
    }

    .register-image-side::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, rgba(220, 53, 69, 0.8), rgba(108, 117, 125, 0.7));
        z-index: 1;
    }

    .register-image-content {
        position: relative;
        z-index: 2;
        color: white;
        text-align: center;
        padding: 2rem;
    }

    /* استایل سمت چپ (فرم) */
    .register-form-side {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
    }

    .register-card {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        width: 100%;
        max-width: 400px;
    }

    .register-card .card-header {
        background-color: #fff;
        border-bottom: 1px solid #e9ecef;
        padding: 2rem 1rem;
        text-align: center;
    }

    .register-card .card-body {
        padding: 2rem 1rem;
    }

    .register-card .form-control {
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
        padding-right: 2.5rem; /* فضا برای آیکون */
        border: 1px solid #ced4da;
        transition: all 0.3s ease;
    }

    .register-card .form-control:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }

    .input-icon {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
        z-index: 10;
    }

    .btn-register {
        padding: 0.75rem;
        font-size: 1rem;
        font-weight: 600;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
    }

    .btn-register:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.4);
    }

    .register-footer-text {
        font-size: 0.9rem;
        color: #6c757d;
    }

    .register-footer-text a {
        color: #dc3545;
        text-decoration: none;
        font-weight: 600;
    }

    /* بهینه‌سازی برای موبایل */
    @media (max-width: 767.98px) {
        .register-form-side {
            background: url('https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1973&q=80') no-repeat center center;
            background-size: cover;
            position: relative;
        }
        .register-form-side::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.9);
            z-index: 1;
        }
        .register-card {
            position: relative;
            z-index: 2;
        }
    }
</style>
@endpush

@section('content')
<div class="register-container">
    <div class="row g-0 min-vh-100">
        {{-- سمت راست: تصویر و متن (مخفی در موبایل) --}}
        <div class="col-md-6 d-none d-md-flex flex-column justify-content-center align-items-center register-image-side">
            <div class="register-image-content">
                <h1 class="display-4 fw-bold">به MiniDivar بپیوندید</h1>
                <p class="lead">اولین قدم برای ثبت آگهی‌های خود را همین امروز بردارید</p>
            </div>
        </div>

        {{-- سمت چپ: فرم ثبت‌نام --}}
        <div class="col-md-6 register-form-side">
            <div class="card register-card">
                <div class="card-header">
                    <i class="bi bi-person-plus" style="font-size: 3rem; color: #dc3545;"></i>
                    <h3 class="mt-2 mb-0 fw-bold">ایجاد حساب کاربری</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- فیلد نام -->
                        <div class="mb-3 position-relative">
                            <label for="name" class="form-label">نام و نام خانوادگی</label>
                            <i class="bi bi-person input-icon"></i>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- فیلد شماره موبایل -->
                        <div class="mb-3 position-relative">
                            <label for="phone" class="form-label">شماره موبایل</label>
                            <i class="bi bi-phone input-icon"></i>
                            <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone') }}" required placeholder="09xxxxxxxxx">
                            @error('phone')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- فیلد ایمیل -->
                        <div class="mb-3 position-relative">
                            <label for="email" class="form-label">ایمیل</label>
                            <i class="bi bi-envelope input-icon"></i>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- فیلد رمز عبور -->
                        <div class="mb-3 position-relative">
                            <label for="password" class="form-label">رمز عبور</label>
                            <i class="bi bi-lock input-icon"></i>
                            <input type="password" id="password" name="password" class="form-control" required>
                            @error('password')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- فیلد تکرار رمز عبور -->
                        <div class="mb-3 position-relative">
                            <label for="password_confirmation" class="form-label">تکرار رمز عبور</label>
                            <i class="bi bi-lock-fill input-icon"></i>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                        </div>

                        <!-- دکمه ثبت‌نام -->
                        <button type="submit" class="btn btn-danger btn-register w-100">
                            <i class="bi bi-person-plus ms-2"></i>ثبت‌نام
                        </button>
                    </form>
                </div>
                <div class="card-footer text-center bg-transparent border-top-0 pt-0">
                    <p class="register-footer-text">
                        قبلاً حساب کاربری دارید؟ <a href="{{ route('login') }}">وارد شوید</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
