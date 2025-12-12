@extends('layouts.app')

@section('title', 'صفحه اصلی - MiniDivar')

@push('styles')
<style>
    /* استایل‌های سفارشی برای صفحه اصلی */
    .main-header {
        color: rgb(0, 0, 0);
        padding: 3rem 0;
        margin-bottom: 2rem;
        border-radius: 0 0 20px 20px;
    }
    .search-form .form-control {
        border-radius: 0.5rem;
        border: 1px solid #ced4da;
        padding: 0.75rem 1rem;
        transition: all 0.2s ease-in-out;
    }
    .search-form .form-control:focus {
        border-color: #e74c3c;
        box-shadow: 0 0 0 0.2rem rgba(231, 76, 60, 0.25);
    }
    .search-form .form-select {
        border-radius: 0.5rem;
        border: 1px solid #ced4da;
        padding: 0.75rem 1rem;
        transition: all 0.2s ease-in-out;
    }
    .search-form .form-label {
        font-weight: 600;
        color: #f8f9fa; /* رنگ روشن برای خوانایی روی پس‌زمینه تیره */
        margin-bottom: 0.5rem;
    }
    .search-form .btn {
        border-radius: 50px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .ad-card {
        transition: all 0.3s ease;
        border: none;
        border-radius: 15px;
        overflow: hidden;
        height: 100%;
    }
    .ad-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }
    .ad-card .card-img-top {
        height: 200px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    .ad-card:hover .card-img-top {
        transform: scale(1.05);
    }
    .ad-badge-new {
        position: absolute;
        top: 10px;
        left: 10px;
        background-color: #28a745;
        color: white;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: bold;
        z-index: 10;
    }
    .ad-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #333;
    }
    .ad-meta {
        font-size: 0.9rem;
        color: #6c757d;
    }
    .ad-price {
        font-size: 1.2rem;
        font-weight: bold;
        color: #e74c3c;
    }
    .btn-details {
        background-color: #e74c3c;
        border: none;
        border-radius: 25px;
        color: white;
        font-weight: 500;
        transition: background-color 0.3s ease;
    }
    .btn-details:hover {
        background-color: #c0392b;
        color: white;
    }
    .empty-state {
        padding: 4rem 2rem;
        text-align: center;
    }
    .empty-state img {
        width: 150px;
        opacity: 0.5;
        margin-bottom: 1rem;
    }
</style>
@endpush

@section('content')
<!-- بخش هدر با جستجو و فیلتر -->
<header class="main-header">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h1 class="display-5 fw-bold">
                    @if(isset($isMyAdsPage))
                        آگهی‌های من
                    @else
                        بهترین آگهی‌ها را پیدا کنید
                    @endif
                </h1>
                <p class="lead">در MiniDivar، کالای خود را پیدا کنید.</p>

                <form action="{{ route('ads.index') }}" method="GET" class="search-form mt-4">
                    <div class="row g-3 align-items-center">
                        <!-- جستجو -->
                        <div class="col-md-4">
                            <label for="search" class="form-label">جستجو در عنوان</label>
                            <input type="text" name="search" class="form-control" placeholder="عنوان آگهی..." value="{{ request('search') }}">
                        </div>
                        <!-- دسته‌بندی -->
                        <div class="col-md-2">
                            <label for="category_id" class="form-label">دسته‌بندی</label>
                            <select name="category_id" class="form-select">
                                <option value="">همه دسته‌بندی‌ها</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- شهر -->
                        <div class="col-md-2">
                            <label for="city" class="form-label">شهر</label>
                            <input type="text" name="city" class="form-control" placeholder="مثال: تهران" value="{{ request('city') }}">
                        </div>
                        <!-- قیمت -->
                        <div class="col-md-2">
                            <label for="min_price" class="form-label">حداقل قیمت</label>
                            <input type="number" name="min_price" class="form-control" placeholder="از (تومان)" value="{{ request('min_price') }}">
                        </div>
                        <!-- دکمه جستجو -->
                        <div class="col-md-2 d-flex gap-2 align-items-end">
                            <button type="submit" class="btn btn-danger flex-fill">جستجو</button>
                            <a href="{{ route('ads.index') }}" class="btn btn-outline-secondary">پاک کردن</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</header>

<!-- بخش نمایش آگهی‌ها -->
<div class="container pb-5">
    <div class="row">
        @forelse($ads as $ad)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card ad-card shadow-sm h-100">
                    {{-- نشانگر "جدید" برای آگهی‌های کمتر از ۳ روز --}}
                    @if($ad->created_at->greaterThan(now()->subDays(3)))
                        <span class="ad-badge-new">جدید</span>
                    @endif

                    {{-- تصویر --}}
                    <a href="{{ route('ads.show', $ad->id) }}">
                        @if($ad->images->isNotEmpty())
                            <img src="{{ asset('storage/' . $ad->images->first()->file_path) }}" class="card-img-top" alt="{{ $ad->title }}">
                        @else
                            <img src="{{ asset('images/no-image.jpg') }}" class="card-img-top" alt="بدون تصویر">
                        @endif
                    </a>

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title ad-title text-truncate">{{ $ad->title }}</h5>

                        <div class="ad-meta mb-2">
                            <span class="ad-price">{{ number_format($ad->price) }} تومان</span>
                            <span class="ms-3"><i class="bi bi-geo-alt-fill"></i> {{ $ad->city }}</span>
                        </div>

                        <p class="card-text text-muted small flex-grow-1 text-truncate">{{ Str::limit($ad->description, 80) }}</p>

                        <div class="card-footer bg-transparent border-top-0 mt-auto pt-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    <i class="bi bi-clock"></i> {{ $ad->created_at->diffForHumans() }}
                                </small>
                                <a href="{{ route('ads.show', $ad->id) }}" class="btn btn-details btn-sm">مشاهده جزئیات</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 empty-state">
                <img src="{{ asset('images/empty-box.svg') }}" alt="هیچ آگهی یافت نشد">
                <h3 class="text-muted">فعلاً آگهی‌ای برای نمایش وجود ندارد.</h3>
                <p class="text-muted">با فیلترهای جدید، جستجوی خود را دقیق‌تر کنید!</p>
                <a href="{{ route('ads.create') }}" class="btn btn-danger mt-3">ثبت آگهی جدید</a>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-5">
        {{ $ads->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
