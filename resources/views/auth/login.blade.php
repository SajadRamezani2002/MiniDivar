@extends('layouts.app')
@section('title', 'ورود')

@push('styles')
<style>
    /* استایل‌های کلی برای صفحه ورود */
    body, html {
        height: 100%;
        background-color: #f8f9fa;
    }

    .login-container {
        min-height: 100vh;
        position: relative;
    }

    /* استایل سمت راست (تصویر) */
    .login-image-side {
        background: url('https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1974&q=80') no-repeat center center;
        background-size: cover;
        position: relative;
    }

    .login-image-side::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, rgba(220, 53, 69, 0.8), rgba(108, 117, 125, 0.7));
        z-index: 1;
    }

    .login-image-content {
        position: relative;
        z-index: 2;
        color: white;
        text-align: center;
        padding: 2rem;
    }

    /* استایل سمت چپ (فرم) */
    .login-form-side {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
    }

    .login-card {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        width: 100%;
        max-width: 400px;
    }

    .login-card .card-header {
        background-color: #fff;
        border-bottom: 1px solid #e9ecef;
        padding: 2rem 1rem;
        text-align: center;
    }

    .login-card .card-body {
        padding: 2rem 1rem;
    }

    .login-card .form-control {
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
        padding-right: 2.5rem; /* فضا برای آیکون */
        border: 1px solid #ced4da;
        transition: all 0.3s ease;
    }

    .login-card .form-control:focus {
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

    .btn-login {
        padding: 0.75rem;
        font-size: 1rem;
        font-weight: 600;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.4);
    }

    .login-footer-text {
        font-size: 0.9rem;
        color: #6c757d;
    }

    .login-footer-text a {
        color: #dc3545;
        text-decoration: none;
        font-weight: 600;
    }

    /* بهینه‌سازی برای موبایل */
    @media (max-width: 767.98px) {
        .login-form-side {
            background: url('https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1974&q=80') no-repeat center center;
            background-size: cover;
            position: relative;
        }
        .login-form-side::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.9);
            z-index: 1;
        }
        .login-card {
            position: relative;
            z-index: 2;
        }
    }
</style>
@endpush

@section('content')
<div class="login-container">
    <div class="row g-0 min-vh-100">
        {{-- سمت راست: تصویر و متن (مخفی در موبایل) --}}
        <div class="col-md-6 d-none d-md-flex flex-column justify-content-center align-items-center login-image-side">
            <div class="login-image-content">
                <h1 class="display-4 fw-bold">به MiniDivar خوش آمدید</h1>
                <p class="lead">پلتفرمی آسان برای ثبت و پیدا کردن آگهی‌های شما</p>
            </div>
        </div>

        {{-- سمت چپ: فرم ورود --}}
        <div class="col-md-6 login-form-side">
            <div class="card login-card">
                <div class="card-header">
                    <i class="bi bi-shop" style="font-size: 3rem; color: #dc3545;"></i>
                    <h3 class="mt-2 mb-0 fw-bold">ورود به حساب کاربری</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- فیلد ایمیل -->
                        <div class="mb-3 position-relative">
                            <label for="email" class="form-label">ایمیل</label>
                            <i class="bi bi-envelope input-icon"></i>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
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

                        <!-- چک‌باکس مرا به خاطر بسپار -->
                        <div class="mb-3 form-check">
                            <input type="checkbox" id="remember" name="remember" class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">مرا به خاطر بسپار</label>
                        </div>

                        <!-- دکمه ورود -->
                        <button type="submit" class="btn btn-danger btn-login w-100">
                            <i class="bi bi-box-arrow-in-right ms-2"></i>ورود
                        </button>
                    </form>
                </div>
                <div class="card-footer text-center bg-transparent border-top-0 pt-0">
                    <p class="login-footer-text">
                        حساب کاربری ندارید؟ <a href="{{ route('register') }}">ثبت‌نام کنید</a>
                    </p>
                    <p class="login-footer-text">
                        <a href="{{ route('password.request') }}">رمز عبور خود را فراموش کرده‌اید؟</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
