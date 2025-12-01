@extends('layouts.app')
@section('title', 'فراموشی رمز عبور')

@push('styles')
<style>
    /* استایل‌های کلی برای صفحه فراموشی رمز عبور */
    body, html {
        height: 100%;
        background-color: #f8f9fa;
    }

    .forgot-password-container {
        min-height: 100vh;
        position: relative;
    }

    /* استایل سمت راست (تصویر) */
    .forgot-password-image-side {
        background: url('https://images.unsplash.com/photo-1583847688964-8a444f35aeca?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1770&q=80') no-repeat center center;
        background-size: cover;
        position: relative;
    }

    .forgot-password-image-side::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, rgba(220, 53, 69, 0.8), rgba(108, 117, 125, 0.7));
        z-index: 1;
    }

    .forgot-password-image-content {
        position: relative;
        z-index: 2;
        color: white;
        text-align: center;
        padding: 2rem;
    }

    /* استایل سمت چپ (فرم) */
    .forgot-password-form-side {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
    }

    .forgot-password-card {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        width: 100%;
        max-width: 400px;
    }

    .forgot-password-card .card-header {
        background-color: #fff;
        border-bottom: 1px solid #e9ecef;
        padding: 2rem 1rem;
        text-align: center;
    }

    .forgot-password-card .card-body {
        padding: 2rem 1rem;
    }

    .forgot-password-card .form-control {
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
        padding-right: 2.5rem; /* فضا برای آیکون */
        border: 1px solid #ced4da;
        transition: all 0.3s ease;
    }

    .forgot-password-card .form-control:focus {
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

    .btn-submit {
        padding: 0.75rem;
        font-size: 1rem;
        font-weight: 600;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.4);
    }

    .forgot-password-footer-text {
        font-size: 0.9rem;
        color: #6c757d;
    }

    .forgot-password-footer-text a {
        color: #dc3545;
        text-decoration: none;
        font-weight: 600;
    }

    /* بهینه‌سازی برای موبایل */
    @media (max-width: 767.98px) {
        .forgot-password-form-side {
            background: url('https://images.unsplash.com/photo-1583847688964-8a444f35aeca?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1770&q=80') no-repeat center center;
            background-size: cover;
            position: relative;
        }
        .forgot-password-form-side::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.9);
            z-index: 1;
        }
        .forgot-password-card {
            position: relative;
            z-index: 2;
        }
    }
</style>
@endpush

@section('content')
<div class="forgot-password-container">
    <div class="row g-0 min-vh-100">
        {{-- سمت راست: تصویر و متن (مخفی در موبایل) --}}
        <div class="col-md-6 d-none d-md-flex flex-column justify-content-center align-items-center forgot-password-image-side">
            <div class="forgot-password-image-content">
                <h1 class="display-4 fw-bold">رمز عبور خود را فراموش کرده‌اید؟</h1>
                <p class="lead">نگران نباشید. ایمیل خود را وارد کنید تا لینک بازیابی را برای شما ارسال کنیم.</p>
            </div>
        </div>

        {{-- سمت چپ: فرم بازیابی رمز عبور --}}
        <div class="col-md-6 forgot-password-form-side">
            <div class="card forgot-password-card">
                <div class="card-header">
                    <i class="bi bi-key-fill" style="font-size: 3rem; color: #dc3545;"></i>
                    <h3 class="mt-2 mb-0 fw-bold">بازیابی رمز عبور</h3>
                </div>
                <div class="card-body">
                    {{-- پیام موفقیت --}}
                    @session('status')
                        <div class="alert alert-success d-flex align-items-center" role="alert">
                            <i class="bi bi-info-circle-fill me-2"></i>
                            {{ $value }}
                        </div>
                    @endsession

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <!-- فیلد ایمیل -->
                        <div class="mb-3 position-relative">
                            <label for="email" class="form-label">ایمیل</label>
                            <i class="bi bi-envelope input-icon"></i>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus autocomplete="username">
                            @error('email')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- دکمه ارسال لینک -->
                        <button type="submit" class="btn btn-danger btn-submit w-100">
                            <i class="bi bi-send ms-2"></i>ارسال لینک بازیابی
                        </button>
                    </form>
                </div>
                <div class="card-footer text-center bg-transparent border-top-0 pt-0">
                    <p class="forgot-password-footer-text">
                        به حساب کاربری خود برگشتید؟ <a href="{{ route('login') }}">وارد شوید</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
