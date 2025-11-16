@extends('layouts.app')
@section('title', 'پنل مدیریت')

@section('content')
<div class="container py-4">
    <h3 class="fw-bold text-danger mb-4">پنل مدیریت MiniDivar</h3>

    {{-- آمار کلی --}}
    <div class="row text-center mb-4">
        <x-admin-stat color="primary" label="کل کاربران" :value="$usersCount" icon="bi-people" />
        <x-admin-stat color="dark" label="کل آگهی‌ها" :value="$totalAds" icon="bi-card-text" />
        <x-admin-stat color="success" label="فعال" :value="$activeAds" icon="bi-check-circle" />
        <x-admin-stat color="warning" label="در انتظار تأیید" :value="$pendingAds" icon="bi-hourglass-split" />
        <x-admin-stat color="danger" label="رد شده" :value="$rejectedAds" icon="bi-x-circle" />
    </div>

    {{-- آگهی‌های اخیر --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-dark text-white">آخرین آگهی‌ها</div>
        <div class="card-body">
            <table class="table table-striped text-center align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>عنوان</th>
                        <th>کاربر</th>
                        <th>دسته</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentAds as $ad)
                        <tr>
                            <td>{{ $ad->id }}</td>
                            <td>{{ $ad->title }}</td>
                            <td>{{ $ad->user->name ?? '-' }}</td>
                            <td>{{ $ad->category->name ?? '-' }}</td>
                            <td>
                                <span class="badge bg-{{ $ad->status === 'active' ? 'success' : ($ad->status === 'pending' ? 'warning' : 'danger') }}">
                                    {{ $ad->status }}
                                </span>
                            </td>
                            <td>
                                @if($ad->status == 'pending')
                                    <form method="POST" action="{{ route('admin.ads.approve', $ad->id) }}" class="d-inline">
                                        @csrf
                                        <button class="btn btn-success btn-sm">تأیید</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.ads.reject', $ad->id) }}" class="d-inline">
                                        @csrf
                                        <button class="btn btn-warning btn-sm">رد</button>
                                    </form>
                                @endif
                                <form method="POST" action="{{ route('admin.ads.delete', $ad->id) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
