@extends('layouts.app')

@section('title', $ad->title)

@push('styles')
<style>
    /* استایل برای بهتر نمایش تصاویر در گالری */
    .main-image-container {
        max-height: 500px;
        overflow: hidden;
    }
    .main-image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    .main-image-container img:hover {
        transform: scale(1.05);
    }

    /* استایل برای تصاویر کوچک (thumbnail) */
    .thumbnail-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        cursor: pointer;
        border: 3px solid #dee2e6;
        transition: border-color 0.2s ease, transform 0.2s ease;
    }
    .thumbnail-image:hover, .thumbnail-image.active {
        border-color: #0d6efd;
        transform: scale(1.1);
    }

    /* چسباندن سایدبار به بالای صفحه با فاصله از هدر */
    .sticky-sidebar {
        position: sticky;
        top: 80px; /* ارتفاع هدر + کمی فاصله */
    }

    /* استایل برای کارت آگهی‌های مشابه */
    .similar-ad-card .card-img-top {
        height: 180px;
        object-fit: cover;
    }
    .similar-ad-card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    .similar-ad-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
</style>
@endpush

@section('content')
<div class="container py-4">

    {{-- مسیر راهنما (Breadcrumb) --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2 rounded">
            <li class="breadcrumb-item"><a href="{{ route('ads.index') }}" class="text-decoration-none">همه آگهی‌ها</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($ad->title, 40) }}</li>
        </ol>
    </nav>

    <div class="row">
        {{-- ستون اصلی: تصاویر و توضیحات --}}
        <div class="col-lg-8">
            {{-- گالری تصاویر --}}
            <div class="card shadow-sm mb-4">
                <div class="card-body p-0">
                    @if($ad->images->isNotEmpty())
                        <div class="main-image-container">
                            <img id="mainImage" src="{{ asset('storage/' . $ad->images->first()->file_path) }}" alt="{{ $ad->title }}">
                        </div>
                        <div class="p-3 d-flex flex-wrap gap-2 justify-content-center">
                            @foreach($ad->images as $image)
                                <img src="{{ asset('storage/' . $image->file_path) }}"
                                     class="thumbnail-image {{ $loop->first ? 'active' : '' }}"
                                     onclick="changeMainImage('{{ asset('storage/' . $image->file_path) }}', this)"
                                     alt="{{ $ad->title }}">
                            @endforeach
                        </div>
                    @else
                        <div class="bg-light text-center p-5">
                            <i class="bi bi-image text-muted" style="font-size: 4rem;"></i>
                            <p class="text-muted mt-2">تصویری برای این آگهی ثبت نشده است.</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- کارت اطلاعات اصلی آگهی --}}
            <div class="card shadow-sm">
                <div class="card-body">
                    <h1 class="h2 mb-3 fw-bold">{{ $ad->title }}</h1>

                    <div class="mb-4 d-flex align-items-center flex-wrap gap-3">
                        <span class="badge bg-primary fs-6 p-2">
                            <i class="bi bi-geo-alt-fill me-1"></i>{{ $ad->city }}
                        </span>
                        <span class="badge bg-secondary fs-6 p-2">
                            <i class="bi bi-tag-fill me-1"></i>{{ $ad->category->name }}
                        </span>
                        <small class="text-muted">
                            <i class="bi bi-clock-history me-1"></i>
                            {{ \Carbon\Carbon::parse($ad->created_at)->diffForHumans() }}
                        </small>
                    </div>

                    <div class="mb-4">
                        <h5 class="fw-bold">توضیحات آگهی</h5>
                        <div class="text-muted" style="white-space: pre-wrap; line-height: 1.8;">{{ $ad->description }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ستون کناری: قیمت، اطلاعات و فروشنده --}}
        <div class="col-lg-4">
            <div class="sticky-sidebar">
                {{-- کارت قیمت و دکمه‌های تماس --}}
                <div class="card shadow-sm mb-4 border-0">
                    <div class="card-body text-center">
                        <h2 class="text-danger mb-3 fw-bold">{{ number_format($ad->price) }} <span class="fs-6">تومان</span></h2>

                        {{-- دکمه تماس با فروشنده --}}
                        <button class="btn btn-success btn-lg w-100 mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#contactSeller" aria-expanded="false" aria-controls="contactSeller">
                            <i class="bi bi-telephone-fill me-2"></i> تماس با فروشنده
                        </button>

                        {{-- بخش بازشونده تماس --}}
                        <div class="collapse mt-2" id="contactSeller">
                            <div class="card card-body text-start">
                                <p class="mb-1"><strong>نام فروشنده:</strong> {{ $ad->user->name ?? 'نامشخص' }}</p>
                                <p class="mb-1"><strong>شماره تماس:</strong> <a href="tel:{{ $ad->user->phone ?? '#' }}">{{ $ad->user->phone ?? '---' }}</a></p>
                                <p class="mb-0"><strong>ارسال پیامک:</strong> <a href="sms:{{ $ad->user->phone ?? '#' }}">ارسال پیامک</a></p>
                            </div>
                        </div>

                        {{-- دکمه چت با فروشنده  --}}
                        <a href="{{ url('/chat/' . $ad->id) }}" class="btn btn-primary btn-lg w-100 mt-2">
                            <i class="bi bi-chat-dots-fill me-2"></i> چت با فروشنده
                        </a>
                    </div>
                </div>

                {{-- کارت اطلاعات فروشنده --}}
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0"><i class="bi bi-person-circle me-2"></i> اطلاعات فروشنده</h5>
                    </div>
                    <div class="card-body text-center">
                        <img src="{{ $ad->user->profile_photo_url ?? asset('images/user.png') }}" class="rounded-circle mb-3 border border-2 border-light shadow-sm" width="80" height="80" style="object-fit: cover;">
                        <h6 class="card-title mb-1">{{ $ad->user->name ?? 'نامشخص' }}</h6>
                        <p class="text-muted small mb-3">عضو {{ \Carbon\Carbon::parse($ad->user->created_at)->diffForHumans() }}</p>
                        <a href="{{ route('ads.index', ['user' => $ad->user->id]) }}" class="btn btn-sm btn-outline-primary w-100">مشاهده سایر آگهی‌ها</a>
                    </div>
                </div>

                {{-- کارت اطلاعات آگهی --}}
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i> اطلاعات آگهی</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <span>کد آگهی:</span>
                            <strong class="text-primary">{{ $ad->id }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>وضعیت:</span>
                            <strong><span class="badge bg-success">فعال</span></strong>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- بخش آگهی‌های مشابه --}}
    @if($similarAds->isNotEmpty())
        <div class="mt-5 pt-4 border-top">
            <h3 class="mb-4 fw-bold"><i class="bi bi-grid-3x3-gap-fill me-2"></i> آگهی‌های مشابه</h3>
            <div class="row">
                @foreach($similarAds as $similarAd)
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                        <div class="card h-100 shadow-sm similar-ad-card">
                            @if($similarAd->images->isNotEmpty())
                                <img src="{{ asset('storage/' . $similarAd->images->first()->file_path) }}" class="card-img-top" alt="{{ $similarAd->title }}">
                            @else
                                <div class="card-img-top d-flex align-items-center justify-content-center bg-light text-muted" style="height: 180px;">
                                    <i class="bi bi-image" style="font-size: 3rem;"></i>
                                </div>
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ Str::limit($similarAd->title, 50) }}</h5>
                                <p class="card-text text-danger fw-bold">{{ number_format($similarAd->price) }} تومان</p>
                                <a href="{{ route('ads.show', $similarAd->id) }}" class="btn btn-primary btn-sm mt-auto">مشاهده جزئیات</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

{{-- جاوااسکریپت برای گالری تصاویر --}}
<script>
function changeMainImage(src, thumbnailElement) {
    document.getElementById('mainImage').src = src;

    // حذف کلاس فعال از تمام تصاویر کوچک
    const thumbnails = document.querySelectorAll('.thumbnail-image');
    thumbnails.forEach(thumb => thumb.classList.remove('active'));

    // اضافه کردن کلاس فعال به تصویر کوچک کلیک شده
    thumbnailElement.classList.add('active');
}
</script>
@endsection
