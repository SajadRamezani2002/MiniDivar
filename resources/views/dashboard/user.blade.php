@extends('layouts.app')
@section('title', 'داشبورد')

@section('content')
<div class="container py-4">
    <h3 class="fw-bold text-danger mb-4">خوش آمدی {{ $user->name }}</h3>

    {{-- آمار آگهی‌های کاربر --}}
    <div class="row text-center mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h5 class="fw-bold text-primary">کل آگهی‌ها</h5>
                    <p class="display-6">{{ $stats['total'] }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h5 class="fw-bold text-warning">در انتظار</h5>
                    <p class="display-6">{{ $stats['pending'] }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h5 class="fw-bold text-success">تأیید شده</h5>
                    <p class="display-6">{{ $stats['active'] }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h5 class="fw-bold text-danger">رد شده</h5>
                    <p class="display-6">{{ $stats['rejected'] }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- آگهی‌های من --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold">آگهی‌های من</h5>
        <a href="{{ route('ads.create') }}" class="btn btn-danger btn-sm">+ ثبت آگهی جدید</a>
    </div>

    <div class="row">
        @forelse ($ads as $ad)
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5>{{ $ad->title }}</h5>
                        <p class="text-muted small">{{ $ad->price }} تومان | {{ $ad->city }}</p>
                        <span class="badge bg-{{ $ad->status === 'active' ? 'success' : ($ad->status === 'pending' ? 'warning' : 'danger') }}">
                            {{ $ad->status }}
                        </span>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-muted">شما هنوز هیچ آگهی ثبت نکرده‌اید.</p>
        @endforelse
    </div>
</div>

{{-- بخش مدیریت کاربران فقط برای ادمین --}}
@if($user->role === 'admin' && isset($users))
<div class="container py-4">
    <h3 class="fw-bold text-danger mb-4">مدیریت کاربران</h3>

    {{-- پیام‌های موفقیت یا خطا --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped text-center align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>نام</th>
                    <th>ایمیل</th>
                    <th>شماره موبایل</th>
                    <th>نقش</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                <tr>
                    <td>{{ $u->id }}</td>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->phone }}</td>
                    <td>{{ $u->role }}</td>
                    <td class="d-flex justify-content-center gap-2">
                        {{-- فعال/غیرفعال --}}
                        <form action="{{ route('admin.users.toggle', $u->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-warning btn-sm" type="submit">
                                {{ $u->role === 'banned' ? 'فعال کردن' : 'غیرفعال کردن' }}
                            </button>
                        </form>

                        {{-- تغییر نقش --}}
                        @if($u->id !== auth()->id() && $u->role !== 'banned')
                        <form action="{{ route('admin.users.toggleRole', $u->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-success btn-sm" type="submit">
                                {{ $u->role === 'admin' ? 'تنزل به کاربر' : 'ارتقا به ادمین' }}
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endif

@endsection
