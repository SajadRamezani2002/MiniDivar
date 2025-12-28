@extends('layouts.app')
@section('title', 'داشبورد ادمین')

@push('styles')
<style>
/* ===========================
   GLOBAL MOBILE FIX
=========================== */
* {
    box-sizing: border-box;
}

html, body {
    max-width: 100%;
    overflow-x: hidden;
}

.container-fluid {
    width: 100%;
    padding-left: 1rem;
    padding-right: 1rem;
}

/* کارت‌ها و آمار کلی */
.card {
    border-radius: 0.5rem;
}

.card-header {
    background-color: #fff;
}

.card-body {
    padding: 1rem;
}

.card h5 {
    font-size: 1rem;
}

/* ردیف آمار کلی */
.row-cols-md-5 > .col-6 {
    margin-bottom: 1rem;
}

/* ===========================
   RESPONSIVE TABLE -> CARD
=========================== */
.responsive-table-container thead {
    display: table-header-group; /* پیش‌فرض دسکتاپ */
}

@media (max-width: 767.98px) {
    .table-responsive table thead {
        display: none;
    }
    .table-responsive table,
    .table-responsive table tbody,
    .table-responsive table tr,
    .table-responsive table td {
        display: block;
        width: 100%;
    }
    .table-responsive table tr {
        margin-bottom: 1rem;
        border: 1px solid #dee2e6;
        border-radius: 0.5rem;
        padding: 1rem;
        background-color: #fff;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }
    .table-responsive table td {
        text-align: right !important;
        padding: 0.5rem 0;
        border: none;
        position: relative;
        padding-left: 35%;
        font-size: 0.9rem;
    }
    .table-responsive table td::before {
        content: attr(data-label);
        position: absolute;
        left: 10px;
        width: 30%;
        font-weight: 600;
        color: #495057;
        font-size: 0.85rem;
    }
    .table-responsive table td:last-child {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        padding-left: 0;
        justify-content: flex-start;
    }
    .table-responsive table td:last-child form,
    .table-responsive table td:last-child a,
    .table-responsive table td:last-child button {
        width: 100%;
        font-size: 0.85rem;
    }

    /* badges */
    .badge {
        font-size: 0.75rem;
        padding: 0.35em 0.5em;
    }
}

/* ===========================
   BUTTON FIXES
=========================== */
.btn-sm {
    font-size: 0.85rem;
    padding: 0.35rem 0.6rem;
}

/* کارت آمار */
.p-3.border.rounded {
    text-align: center;
}

.p-3.border.rounded i {
    display: block;
    margin-bottom: 0.5rem;
}
</style>
@endpush

@section('content')
<div class="container-fluid p-4">
    <!-- بخش آمار کلی -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold">
                <i class="bi bi-graph-up-arrow ms-2 text-primary"></i>
                آمار کلی
            </h5>
        </div>
        <div class="card-body">
            <div class="row row-cols-md-5 text-center">
                <div class="col-6 col-md mb-3">
                    <div class="p-3 border rounded">
                        <i class="bi bi-people-fill text-primary fs-3"></i>
                        <h6 class="mt-2 mb-1 fw-bold text-primary">کل کاربران</h6>
                        <p class="mb-0 fs-4 fw-bold">{{ $usersCount ?? 0 }}</p>
                    </div>
                </div>
                <div class="col-6 col-md mb-3">
                    <div class="p-3 border rounded">
                        <i class="bi bi-card-text text-info fs-3"></i>
                        <h6 class="mt-2 mb-1 fw-bold text-info">کل آگهی‌ها</h6>
                        <p class="mb-0 fs-4 fw-bold">{{ $totalAds ?? 0 }}</p>
                    </div>
                </div>
                <div class="col-6 col-md mb-3">
                    <div class="p-3 border rounded">
                        <i class="bi bi-check-circle-fill text-success fs-3"></i>
                        <h6 class="mt-2 mb-1 fw-bold text-success">فعال</h6>
                        <p class="mb-0 fs-4 fw-bold">{{ $activeAds ?? 0 }}</p>
                    </div>
                </div>
                <div class="col-6 col-md mb-3">
                    <div class="p-3 border rounded">
                        <i class="bi bi-clock-fill text-warning fs-3"></i>
                        <h6 class="mt-2 mb-1 fw-bold text-warning">در انتظار تأیید</h6>
                        <p class="mb-0 fs-4 fw-bold">{{ $pendingAds ?? 0 }}</p>
                    </div>
                </div>
                <div class="col-6 col-md mb-3">
                    <div class="p-3 border rounded">
                        <i class="bi bi-x-circle-fill text-danger fs-3"></i>
                        <h6 class="mt-2 mb-1 fw-bold text-danger">رد شده</h6>
                        <p class="mb-0 fs-4 fw-bold">{{ $rejectedAds ?? 0 }}</p>
                    </div>
                 </div>
            </div>
        </div>
    </div>

    <!-- بخش آخرین آگهی‌ها -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold">
                <i class="bi bi-list-ul ms-2 text-primary"></i>
                آخرین آگهی‌ها
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive responsive-table-container">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">عنوان</th>
                            <th scope="col">کاربر</th>
                            <th scope="col">دسته</th>
                            <th scope="col">وضعیت</th>
                            <th scope="col" class="text-center">عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentAds as $ad)
                            <tr>
                                <td data-label="#">{{ $ad->id }}</td>
                                <td data-label="عنوان">{{ Str::limit($ad->title, 40) }}</td>
                                <td data-label="کاربر">{{ $ad->user->name ?? '-' }}</td>
                                <td data-label="دسته">{{ $ad->category->name ?? '-' }}</td>
                                <td data-label="وضعیت">
                                    @switch($ad->status)
                                        @case('active')
                                            <span class="badge bg-success">فعال</span>
                                            @break
                                        @case('pending')
                                            <span class="badge bg-warning text-dark">در انتظار</span>
                                            @break
                                        @case('rejected')
                                            <span class="badge bg-danger">رد شده</span>
                                            @break
                                    @endswitch
                                </td>
                                <td data-label="عملیات" class="text-center">
                                    <div class="btn-group d-flex flex-wrap gap-1 justify-content-center">
                                        <a href="{{ route('ads.show', $ad->id) }}" class="btn btn-info btn-sm flex-fill">مشاهده</a>
                                        @if($ad->status == 'pending')
                                            <form method="POST" action="{{ route('admin.ads.approve', $ad->id) }}" class="d-inline flex-fill">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm w-100">تأیید</button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.ads.reject', $ad->id) }}" class="d-inline flex-fill">
                                                @csrf
                                                <button type="submit" class="btn btn-warning btn-sm w-100">رد</button>
                                            </form>
                                        @endif
                                        <form method="POST" action="{{ route('admin.ads.delete', $ad->id) }}" class="d-inline flex-fill" onsubmit="return confirm('آیا از حذف این آگهی مطمئن هستید؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm w-100">حذف</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">هیچ آگهی یافت نشد.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- بخش مدیریت کاربران -->
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
                                    <form action="{{ route('admin.users.toggle', $u->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-{{ $u->role === 'banned' ? 'success' : 'warning' }} btn-sm w-100">
                                            <i class="bi bi-{{ $u->role === 'banned' ? 'unlock-fill' : 'ban-fill' }} me-1"></i>
                                            {{ $u->role === 'banned' ? 'فعال ' : 'مسدود ' }}
                                        </button>
                                    </form>
                                    @if($u->id !== auth()->id() && $u->role !== 'banned')
                                        <form action="{{ route('admin.users.toggleRole', $u->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-info btn-sm w-100">
                                                <i class="bi bi-{{ $u->role === 'admin' ? 'arrow-down-circle-fill' : 'arrow-up-circle-fill' }} me-1"></i>
                                                {{ $u->role === 'admin' ? 'تنزل' : 'ارتقا' }}
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

            <div class="d-flex justify-content-center mt-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
