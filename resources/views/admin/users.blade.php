{{-- تغییر لایه‌ی اصلی به layouts.app برای هماهنگی ظاهری --}}
@extends('layouts.app')
@section('title', 'مدیریت کاربران')

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

    {{-- کارت اصلی برای نمایش جدول کاربران --}}
    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold">
                <i class="bi bi-people-fill ms-2 text-primary"></i>
                مدیریت کاربران
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive responsive-table-container">
                <table class="table modern-table align-middle">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"><i class="bi bi-person me-1"></i>نام</th>
                            <th scope="col"><i class="bi bi-envelope me-1"></i>ایمیل</th>
                            <th scope="col"><i class="bi bi-phone me-1"></i>موبایل</th>
                            <th scope="col"><i class="bi bi-shield me-1"></i>نقش</th>
                            <th scope="col" class="text-center"><i class="bi bi-gear me-1"></i>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td data-label="#">{{ $user->id }}</td>
                                <td data-label="نام">{{ $user->name }}</td>
                                <td data-label="ایمیل">{{ $user->email }}</td>
                                <td data-label="موبایل">{{ $user->phone }}</td>
                                <td data-label="نقش">
                                    @switch($user->role)
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
                                <td data-label="عملیات">
                                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                                        {{-- دکمه فعال/مسدود کردن --}}
                                        <form action="{{ route('admin.users.toggle', $user->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-{{ $user->role === 'banned' ? 'success' : 'warning' }} btn-sm">
                                                <i class="bi bi-{{ $user->role === 'banned' ? 'unlock-fill' : 'ban-fill' }} me-1"></i>
                                                {{ $user->role === 'banned' ? 'فعال ' : 'مسدود ' }}
                                            </button>
                                        </form>

                                        {{-- دکمه ارتقا/تنزل نقش --}}
                                        @if($user->id !== auth()->id() && $user->role !== 'banned')
                                            <form action="{{ route('admin.users.toggleRole', $user->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-info btn-sm">
                                                    <i class="bi bi-{{ $user->role === 'admin' ? 'arrow-down-circle-fill' : 'arrow-up-circle-fill' }} me-1"></i>
                                                    {{ $user->role === 'admin' ? 'تنزیل' : 'ارتقا' }}
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <i class="bi bi-person-x text-muted" style="font-size: 4rem;"></i>
                                    <p class="text-muted mt-3">هیچ کاربری یافت نشد.</p>
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
