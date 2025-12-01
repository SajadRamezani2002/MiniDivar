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
            <div class="row text-center">
                <div class="col-6 col-md-3 mb-3">
                    <div class="p-3 border rounded">
                        <i class="bi bi-people-fill text-primary fs-3"></i>
                        <h6 class="mt-2 mb-1 fw-bold text-primary">کل کاربران</h6>
                        <p class="mb-0 fs-4 fw-bold">{{ $usersCount ?? 0 }}</p>
                    </div>
                </div>
                <div class="col-6 col-md-3 mb-3">
                    <div class="p-3 border rounded">
                        <i class="bi bi-card-text text-info fs-3"></i>
                        <h6 class="mt-2 mb-1 fw-bold text-info">کل آگهی‌ها</h6>
                        <p class="mb-0 fs-4 fw-bold">{{ $totalAds ?? 0 }}</p>
                    </div>
                </div>
                <div class="col-6 col-md-3 mb-3">
                    <div class="p-3 border rounded">
                        <i class="bi bi-check-circle-fill text-success fs-3"></i>
                        <h6 class="mt-2 mb-1 fw-bold text-success">فعال</h6>
                        <p class="mb-0 fs-4 fw-bold">{{ $activeAds ?? 0 }}</p>
                    </div>
                </div>
                <div class="col-6 col-md-3 mb-3">
                    <div class="p-3 border rounded">
                        <i class="bi bi-clock-fill text-warning fs-3"></i>
                        <h6 class="mt-2 mb-1 fw-bold text-warning">در انتظار تأیید</h6>
                        <p class="mb-0 fs-4 fw-bold">{{ $pendingAds ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- بخش آخرین آگهی‌ها -->
    <div class="card shadow-sm">
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
</div>
@endsection
