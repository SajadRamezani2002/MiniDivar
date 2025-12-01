@extends('layouts.app')
@section('title', 'داشبورد')

@push('styles')
<style>
    /* استایل‌های سفارشی برای جدول مدرن */
    .modern-table thead th {
        font-weight: 600;
        color: #495057;
        border-bottom: 2px solid #dee2e6;
        background-color: #f8f9fa;
    }
    .modern-table tbody td {
        vertical-align: middle;
        border-color: #f1f3f5;
    }
    .modern-table tbody tr:hover {
        background-color: #f8f9fa;
    }

    /* استایل برای کارت آگهی */
    .ad-card .card-img-top {
        height: 200px;
        object-fit: cover;
        background-color: #e9ecef;
    }
    .ad-card .card-footer {
        background-color: #f8f9fa;
    }

    /* --- استایل‌های واکنش‌گرا (Responsive) --- */

    /* تبدیل جدول به کارت در موبایل */
    @media (max-width: 767.98px) {
        .responsive-table-container thead {
            display: none;
        }
        .responsive-table-container,
        .responsive-table-container tbody,
        .responsive-table-container tr,
        .responsive-table-container td {
            display: block;
            width: 100%;
        }
        .responsive-table-container tr {
            margin-bottom: 1rem;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            padding: 1rem;
            background-color: #fff;
        }
        .responsive-table-container td {
            text-align: right !important; /* راست‌چین کردن متن در موبایل */
            padding: 0.5rem 0;
            border: none;
            position: relative;
            padding-left: 35%; /* فضا برای لیبل */
        }
        .responsive-table-container td::before {
            content: attr(data-label);
            position: absolute;
            left: 10px;
            width: 30%;
            font-weight: bold;
            color: #495057;
        }
        /* استایل دکمه‌ها در حالت کارت */
        .responsive-table-container td:last-child {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            padding-left: 0;
        }
        .responsive-table-container td:last-child form {
            width: 100%;
        }
        .responsive-table-container td:last-child button {
            width: 100%;
        }
    }
</style>
@endpush

@section('content')
<div class="container py-4">

    {{-- کارت خوشامدگویی و آمار --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold">
                <i class="bi bi-person-circle ms-2 text-primary"></i>
                خوش آمدید، {{ $user->name }}
            </h5>
        </div>
        <div class="card-body">
            <div class="row text-center">
                <div class="col-6 col-md-3 mb-3">
                    <div class="border rounded p-3">
                        <i class="bi bi-collection text-primary fs-3"></i>
                        <h6 class="mt-2 mb-1 fw-bold text-primary">کل آگهی‌ها</h6>
                        <p class="mb-0 fs-4 fw-bold">{{ $stats['total'] }}</p>
                    </div>
                </div>
                <div class="col-6 col-md-3 mb-3">
                    <div class="border rounded p-3">
                        <i class="bi bi-clock-history text-warning fs-3"></i>
                        <h6 class="mt-2 mb-1 fw-bold text-warning">در انتظار</h6>
                        <p class="mb-0 fs-4 fw-bold">{{ $stats['pending'] }}</p>
                    </div>
                </div>
                <div class="col-6 col-md-3 mb-3">
                    <div class="border rounded p-3">
                        <i class="bi bi-check-circle text-success fs-3"></i>
                        <h6 class="mt-2 mb-1 fw-bold text-success">تأیید شده</h6>
                        <p class="mb-0 fs-4 fw-bold">{{ $stats['active'] }}</p>
                    </div>
                </div>
                <div class="col-6 col-md-3 mb-3">
                    <div class="border rounded p-3">
                        <i class="bi bi-x-circle text-danger fs-3"></i>
                        <h6 class="mt-2 mb-1 fw-bold text-danger">رد شده</h6>
                        <p class="mb-0 fs-4 fw-bold">{{ $stats['rejected'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- کارت آگهی‌های من --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center flex-wrap">
            <h5 class="mb-0 fw-bold">
                <i class="bi bi-grid-3x3-gap ms-2 text-primary"></i>
                آگهی‌های من
            </h5>
            <a href="{{ route('ads.create') }}" class="btn btn-danger btn-sm mt-2 mt-md-0">
                <i class="bi bi-plus-circle ms-1"></i> ثبت آگهی جدید
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                @forelse ($ads as $ad)
                    <div class="col-lg-4 col-md-6 col-12 mb-4">
                        <div class="card ad-card h-100 shadow-sm">
                            @if($ad->images->isNotEmpty())
                                <img src="{{ asset('storage/' . $ad->images->first()->file_path) }}" class="card-img-top" alt="{{ $ad->title }}">
                            @else
                                <div class="card-img-top d-flex align-items-center justify-content-center bg-light text-muted">
                                    <i class="bi bi-image" style="font-size: 3rem;"></i>
                                </div>
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ Str::limit($ad->title, 50) }}</h5>
                                <p class="card-text text-muted small">
                                    <i class="bi bi-tag ms-1"></i>{{ number_format($ad->price) }} تومان
                                    <span class="mx-2">|</span>
                                    <i class="bi bi-geo-alt ms-1"></i>{{ $ad->city }}
                                </p>
                                <div class="mt-auto">
                                    <span class="badge bg-{{ $ad->status === 'active' ? 'success' : ($ad->status === 'pending' ? 'warning' : 'danger') }} d-inline-flex align-items-center">
                                        @if($ad->status === 'active') <i class="bi bi-check-circle-fill me-1"></i> @endif
                                        @if($ad->status === 'pending') <i class="bi bi-clock-fill me-1"></i> @endif
                                        @if($ad->status === 'rejected') <i class="bi bi-x-circle-fill me-1"></i> @endif
                                        {{ $ad->status === 'active' ? 'فعال' : ($ad->status === 'pending' ? 'در انتظار' : 'رد شده') }}
                                    </span>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-top-0">
                                <div class="btn-group w-100" role="group">
                                    <a href="{{ route('ads.edit', $ad->id) }}" class="btn btn-outline-warning btn-sm">
                                        <i class="bi bi-pencil"></i> ویرایش
                                    </a>
                                    <form method="POST" action="{{ route('ads.destroy', $ad->id) }}" onsubmit="return confirm('آیا از حذف این آگهی مطمئن هستید؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                            <i class="bi bi-trash"></i> حذف
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-inbox text-muted" style="font-size: 4rem;"></i>
                        <p class="text-muted mt-3">شما هنوز هیچ آگهی ثبت نکرده‌اید.</p>
                        <a href="{{ route('ads.create') }}" class="btn btn-danger mt-2">
                            <i class="bi bi-plus-circle ms-1"></i> ثبت اولین آگهی
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- بخش مدیریت کاربران فقط برای ادمین --}}
    @if($user->role === 'admin' && isset($users))
    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold">
                <i class="bi bi-people-fill ms-2 text-primary"></i>
                مدیریت کاربران
            </h5>
        </div>
        <div class="card-body">
            {{-- پیام‌های موفقیت یا خطا --}}
            @if(session('success'))
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    {{ session('error') }}
                </div>
            @endif

            <div class="table-responsive responsive-table-container">
                <table class="table modern-table align-middle">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"><i class="bi bi-person me-1"></i> نام</th>
                            <th scope="col"><i class="bi bi-envelope me-1"></i> ایمیل</th>
                            <th scope="col"><i class="bi bi-phone me-1"></i> موبایل</th>
                            <th scope="col"><i class="bi bi-shield me-1"></i> نقش</th>
                            <th scope="col" class="text-center">عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $u)
                        <tr>
                            <td data-label="#">{{ $u->id }}</td>
                            <td data-label="نام">{{ $u->name }}</td>
                            <td data-label="ایمیل">{{ $u->email }}</td>
                            <td data-label="موبایل">{{ $u->phone }}</td>
                            <td data-label="نقش">
                                @switch($u->role)
                                    @case('admin')
                                        <span class="badge bg-primary"><i class="bi bi-shield-fill-check me-1"></i> ادمین</span>
                                        @break
                                    @case('user')
                                        <span class="badge bg-secondary"><i class="bi bi-person me-1"></i> کاربر</span>
                                        @break
                                    @case('banned')
                                        <span class="badge bg-danger"><i class="bi bi-shield-x me-1"></i> مسدود</span>
                                        @break
                                @endswitch
                            </td>
                            <td data-label="عملیات" class="text-center">
                                <div class="d-flex justify-content-center gap-2 flex-wrap">
                                    {{-- دکمه فعال/مسدود کردن --}}
                                    <form action="{{ route('admin.users.toggle', $u->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-{{ $u->role === 'banned' ? 'success' : 'warning' }} btn-sm">
                                            <i class="bi bi-{{ $u->role === 'banned' ? 'unlock-fill' : 'ban-fill' }} me-1"></i>
                                            {{ $u->role === 'banned' ? 'فعال ' : 'مسدود ' }}
                                        </button>
                                    </form>

                                    {{-- دکمه ارتقا/تنزیل نقش --}}
                                    @if($u->id !== auth()->id() && $u->role !== 'banned')
                                        <form action="{{ route('admin.users.toggleRole', $u->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-info btn-sm">
                                                <i class="bi bi-{{ $u->role === 'admin' ? 'arrow-down-circle-fill' : 'arrow-up-circle-fill' }} me-1"></i>
                                                {{ $u->role === 'admin' ? 'تنزیل' : 'ارتقا' }}
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>
    @endif

</div>
@endsection
