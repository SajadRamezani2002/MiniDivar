@extends('layouts.app')
@section('title', 'ثبت‌نام')
@section('content')
<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="card shadow-sm">
      <div class="card-header text-center bg-dark text-white">ثبت‌نام کاربر جدید</div>
      <div class="card-body">
        {{-- <x-validation-errors class="mb-4" /> --}}
        <form method="POST" action="{{ route('register') }}">
          @csrf
          <div class="mb-3">
            <label class="form-label">نام و نام خانوادگی</label>
            <input type="text" name="name" class="form-control" required>
          </div>
            <div class="mt-3">
                <label class="form-label">شماره موبایل</label>
                <input id="phone" type="text" name="phone" class="form-control" required placeholder="9xxxxxxxxx">
            </div>
          <div class="mb-3">
            <label class="form-label">ایمیل</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">رمز عبور</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">تکرار رمز عبور</label>
            <input type="password" name="password_confirmation" class="form-control" required>
          </div>
            {{-- نمایش خطاها --}}
            @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ __($error) }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
          <button class="btn btn-danger w-100">ثبت‌نام</button>
          <div class="text-center mt-3">
            <a href="{{ route('login') }}">ورود به حساب کاربری</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
