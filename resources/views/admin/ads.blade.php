{{-- تغییر لایه‌ی اصلی به layouts.app برای هماهنگی ظاهری --}}
@extends('layouts.app')
@section('title', 'مدیریت آگهی‌ها')

@push('styles')
<style>
    /* استایل‌های سفارشی برای جدول مدرن (مانند داشبورد) */
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

    {{-- کارت اصلی برای نمایش جدول آگهی‌ها --}}
    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold">
                <i class="bi bi-megaphone-fill ms-2 text-primary"></i>
                مدیریت آگهی‌ها
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive responsive-table-container">
                <table class="table modern-table align-middle">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"><i class="bi bi-tag me-1"></i>عنوان</th>
                            <th scope="col"><i class="bi bi-person me-1"></i>کاربر</th>
                            <th scope="col"><i class="bi bi-folder me-1"></i>دسته</th>
                            <th scope="col"><i class="bi bi-flag me-1"></i>وضعیت</th>
                            <th scope="col" class="text-center"><i class="bi bi-gear me-1"></i>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($ads as $ad)
                            <tr>
                                <td data-label="#">{{ $ad->id }}</td>
                                <td data-label="عنوان">{{ Str::limit($ad->title, 50) }}</td>
                                <td data-label="کاربر">{{ $ad->user->name ?? '-' }}</td>
                                <td data-label="دسته">{{ $ad->category->name ?? '-' }}</td>
                                <td data-label="وضعیت">
                                    @switch($ad->status)
                                        @case('active')
                                            <span class="badge bg-success"><i class="bi bi-check-circle-fill me-1"></i>فعال</span>
                                            @break
                                        @case('pending')
                                            <span class="badge bg-warning text-dark"><i class="bi bi-clock-fill me-1"></i>در انتظار تأیید</span>
                                            @break
                                        @case('rejected')
                                            <span class="badge bg-danger"><i class="bi bi-x-circle-fill me-1"></i>رد شده</span>
                                            @break
                                    @endswitch
                                </td>
                                <td data-label="عملیات">
                                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                                        @if($ad->status == 'pending')
                                            <form method="POST" action="{{ route('admin.ads.approve', $ad->id) }}" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    <i class="bi bi-check-lg"></i> تأیید
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.ads.reject', $ad->id) }}" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-warning btn-sm">
                                                    <i class="bi bi-x-lg"></i> رد
                                                </button>
                                            </form>
                                        @endif
                                        <form method="POST" action="{{ route('admin.ads.delete', $ad->id) }}" class="d-inline" onsubmit="return confirm('آیا از حذف این آگهی مطمئن هستید؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i> حذف
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <i class="bi bi-inbox text-muted" style="font-size: 4rem;"></i>
                                    <p class="text-muted mt-3">هیچ آگهی یافت نشد.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>
@endsection
