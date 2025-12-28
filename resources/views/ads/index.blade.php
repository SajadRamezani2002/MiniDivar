@extends('layouts.app')

@section('title', 'صفحه اصلی - MiniDivar')

@push('styles')
<style>
/* ===========================
   GLOBAL RESET
=========================== */
* {
    box-sizing: border-box;
}

html, body {
    width: 100%;
    max-width: 100%;
    overflow-x: hidden;
}

/* ===========================
   HEADER
=========================== */
.main-header {
    color: #000;
    padding: 2.2rem 0; /* ⬅️ کمتر شد */
    margin-bottom: 1.5rem; /* ⬅️ کمتر شد */
    border-radius: 0 0 20px 20px;
}

.main-header h1 {
    margin-bottom: 0.4rem; /* ⬅️ فاصله کمتر */
}

.main-header .lead {
    margin-bottom: 0.6rem; /* ⬅️ فاصله کمتر */
}

/* ===========================
   PAGE WRAPPER (FIX WIDTH)
=========================== */
.page-wrapper {
    width: 1200px;
    max-width: 94vw;
    margin: 0 auto;
    overflow-x: hidden;
}

/* ===========================
   SEARCH FORM
=========================== */
.search-form {
    margin-top: 0.5rem !important; /* ⬅️ فاصله کمتر با متن بالا */
}

.search-form .row {
    margin-left: 0;
    margin-right: 0;
}

.search-btn-wrapper {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    justify-content: flex-end;
}

.search-btn {
    height: 44px;
    border-radius: 30px;
    font-weight: 600;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.search-btn-danger {
    background: #e74c3c;
    border: none;
    color: #fff;
}

.search-btn-outline-danger {
    background: #fff;
    border: 2px solid #e74c3c;
    color: #e74c3c;
}

/* ===========================
   ADS GRID
=========================== */
.ads-row {
    margin: 0;
}

.ads-row > [class*="col-"] {
    padding-left: 0.5rem;
    padding-right: 0.5rem;
}

.ad-card {
    width: 100%;
    max-width: 100%;
    border-radius: 14px;
    overflow: hidden;
    height: 100%;
}

.ad-card img {
    width: 100%;
    height: 190px;
    object-fit: cover;
    display: block;
}

/* ===========================
   BADGE
=========================== */
.ad-badge-new {
    position: absolute;
    top: 10px;
    left: 10px;
    background: #28a745;
    color: #fff;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 0.7rem;
    z-index: 2;
}

/* ===========================
   DETAILS BUTTON
=========================== */
.btn-details {
    background: #e74c3c;
    color: #fff;
    border: none;
    border-radius: 25px;
    padding: 6px 16px;
    font-size: 0.85rem;
}

/* ===========================
   MOBILE
=========================== */
@media (max-width: 768px) {

    .main-header {
        padding: 1.6rem 0 1.4rem;
        margin-bottom: 1rem;
    }

    .main-header h1 {
        margin-bottom: 0.3rem;
        font-size: 1.4rem;
    }

    .main-header .lead {
        margin-bottom: 0.4rem;
        font-size: 0.9rem;
    }

    .page-wrapper {
        max-width: 92vw;
    }

    .search-form {
        margin-top: 0.4rem !important;
    }

    .ad-card img {
        height: 180px;
    }
}
</style>
@endpush

@section('content')

<!-- HEADER -->
<header class="main-header">
    <div class="container">
        <h1 class="fw-bold">
            {{ isset($isMyAdsPage) ? 'آگهی‌های من' : 'خوش آمدید به MiniDivar' }}
        </h1>
        <p class="lead">در MiniDivar، کالای خود را پیدا کنید.</p>
    </div>
</header>

<!-- CONTENT -->
<div class="page-wrapper">

    <!-- SEARCH -->
    <form action="{{ route('ads.index') }}" method="GET" class="search-form mb-4">
        <div class="row g-2">
            <div class="col-12 col-md-4">
                <input type="text" name="search" class="form-control" placeholder="عنوان آگهی" value="{{ request('search') }}">
            </div>

            <div class="col-12 col-md-2">
                <select name="category_id" class="form-select">
                    <option value="">دسته‌بندی</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 col-md-2">
                <input type="text" name="city" class="form-control" placeholder="شهر" value="{{ request('city') }}">
            </div>

            <div class="col-12 col-md-2">
                <input type="number" name="min_price" class="form-control" placeholder="حداقل قیمت" value="{{ request('min_price') }}">
            </div>

            <div class="col-12 col-md-2 search-btn-wrapper">
                <button type="submit" class="search-btn search-btn-danger">
                    جستجو
                </button>
                <a href="{{ route('ads.index') }}" class="search-btn search-btn-outline-danger">
                    پاک کردن
                </a>
            </div>
        </div>
    </form>

    <!-- ADS -->
    <div class="row ads-row">
        @forelse($ads as $ad)
            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <div class="card ad-card position-relative">

                    @if($ad->created_at->greaterThan(now()->subDays(3)))
                        <span class="ad-badge-new">جدید</span>
                    @endif

                    <img src="{{ $ad->images->isNotEmpty()
                        ? asset('storage/'.$ad->images->first()->file_path)
                        : asset('images/no-image.jpg') }}">

                    <div class="card-body d-flex flex-column">
                        <h6 class="text-truncate">{{ $ad->title }}</h6>

                        <strong class="text-danger mb-1">
                            {{ number_format($ad->price) }} تومان
                        </strong>

                        <div class="text-muted small mb-2">
                            {{ $ad->city }}
                        </div>

                        <a href="{{ route('ads.show', $ad->id) }}"
                           class="btn btn-details btn-sm mt-auto align-self-start">
                            مشاهده جزئیات
                        </a>
                    </div>

                </div>
            </div>
        @empty
            <div class="text-center py-5">آگهی‌ای یافت نشد</div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $ads->links('pagination::bootstrap-4') }}
    </div>

</div>
@endsection
