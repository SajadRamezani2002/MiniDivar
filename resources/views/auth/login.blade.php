@extends('layouts.app')
@section('title', 'ورود')
@section('content')
<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="card shadow-sm">
      <div class="card-header text-center bg-dark text-white">ورود به MiniDivar</div>
      <div class="card-body">
        <form method="POST" action="{{ route('login') }}">
          @csrf
          <div class="mb-3">
            <label class="form-label">ایمیل</label>
            <input type="email" name="email" class="form-control" required autofocus>
          </div>
          <div class="mb-3">
            <label class="form-label">رمز عبور</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" name="remember">
            <label class="form-check-label">مرا به خاطر بسپار</label>
          </div>
          <button class="btn btn-danger w-100">ورود</button>
          <div class="text-center mt-3">
            <a href="{{ route('register') }}">ثبت‌نام کاربر جدید</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
