@extends('layouts.app')

@section('title', 'صفحه اصلی - MiniDivar')

@section('content')
<div class="container py-5">

    <h2 class="fw-bold text-center mb-5">آخرین آگهی‌ها</h2>

    <div class="row g-4">

        {{-- آگهی ۱ --}}
        <div class="col-md-3 col-sm-6">
            <div class="card h-100 shadow-sm border-0">
                <img src="{{ asset('images/placeholder1.jpg') }}" class="card-img-top" style="height:180px; object-fit:cover;" alt="گوشی سامسونگ">
                <div class="card-body">
                    <h5 class="card-title">گوشی سامسونگ مدل Galaxy X</h5>
                    <p class="card-text text-muted small mb-1">دسته: موبایل | شهر: تهران</p>
                    <p class="fw-bold text-danger mb-2">۱۵,۰۰۰,۰۰۰ تومان</p>
                    <button class="btn btn-secondary w-100" disabled>نمایشی</button>
                </div>
            </div>
        </div>

        {{-- آگهی ۲ --}}
        <div class="col-md-3 col-sm-6">
            <div class="card h-100 shadow-sm border-0">
                <img src="{{ asset('images/placeholder2.jpg') }}" class="card-img-top" style="height:180px; object-fit:cover;" alt="آپارتمان ۲ خوابه">
                <div class="card-body">
                    <h5 class="card-title">آپارتمان ۲ خوابه در نیاوران</h5>
                    <p class="card-text text-muted small mb-1">دسته: املاک | شهر: اصفهان</p>
                    <p class="fw-bold text-danger mb-2">۵,۵۰۰,۰۰۰,۰۰۰ تومان</p>
                    <button class="btn btn-secondary w-100" disabled>نمایشی</button>
                </div>
            </div>
        </div>

        {{-- آگهی ۳ --}}
        <div class="col-md-3 col-sm-6">
            <div class="card h-100 shadow-sm border-0">
                <img src="{{ asset('images/placeholder3.jpg') }}" class="card-img-top" style="height:180px; object-fit:cover;" alt="لپ تاپ گیمینگ">
                <div class="card-body">
                    <h5 class="card-title">لپ‌تاپ گیمینگ ASUS ROG</h5>
                    <p class="card-text text-muted small mb-1">دسته: کالای دیجیتال | شهر: مشهد</p>
                    <p class="fw-bold text-danger mb-2">۳۲,۰۰۰,۰۰۰ تومان</p>
                    <button class="btn btn-secondary w-100" disabled>نمایشی</button>
                </div>
            </div>
        </div>

        {{-- آگهی ۴ --}}
        <div class="col-md-3 col-sm-6">
            <div class="card h-100 shadow-sm border-0">
                <img src="{{ asset('images/placeholder4.jpg') }}" class="card-img-top" style="height:180px; object-fit:cover;" alt="دوچرخه شهری">
                <div class="card-body">
                    <h5 class="card-title">دوچرخه شهری نو</h5>
                    <p class="card-text text-muted small mb-1">دسته: وسایل نقلیه | شهر: کرج</p>
                    <p class="fw-bold text-danger mb-2">۲,۰۰۰,۰۰۰ تومان</p>
                    <button class="btn btn-secondary w-100" disabled>نمایشی</button>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
