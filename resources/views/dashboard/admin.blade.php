@extends('layouts.app')
@section('title', 'داشبورد ادمین')

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

    <!-- بخش آخرین آگهی‌ها -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold">
                <i class="bi bi-list-ul ms-2 text-primary"></i>
                آخرین آگهی‌ها
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
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
                                <td>{{ $ad->id }}</td>
                                <td>{{ Str::limit($ad->title, 40) }}</td>
                                <td>{{ $ad->user->name ?? '-' }}</td>
                                <td>{{ $ad->category->name ?? '-' }}</td>
                                <td>
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
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <!-- دکمه مشاهده -->
                                        <a href="{{ route('ads.show', $ad->id) }}" class="btn btn-info btn-sm">مشاهده</a>
                                        @if($ad->status == 'pending')
                                            <!-- دکمه تأیید -->
                                            <form method="POST" action="{{ route('admin.ads.approve', $ad->id) }}" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">تأیید</button>
                                            </form>
                                            <!-- دکمه رد -->
                                            <form method="POST" action="{{ route('admin.ads.reject', $ad->id) }}" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-warning btn-sm">رد</button>
                                            </form>
                                        @endif
                                        <!-- دکمه حذف -->
                                        <form method="POST" action="{{ route('admin.ads.delete', $ad->id) }}" class="d-inline" onsubmit="return confirm('آیا از حذف این آگهی مطمئن هستید؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">حذف</button>
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
    <div class="card shadow-sm ">
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
                                        <button type="submit" class="btn btn-{{ $u->role === 'banned' ? 'success' : 'warning' }} btn-sm">
                                            <i class="bi bi-{{ $u->role === 'banned' ? 'unlock-fill' : 'ban-fill' }} me-1"></i>
                                            {{ $u->role === 'banned' ? 'فعال ' : 'مسدود ' }}
                                        </button>
                                    </form>
                                    @if($u->id !== auth()->id() && $u->role !== 'banned')
                                        <form action="{{ route('admin.users.toggleRole', $u->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-info btn-sm">
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
