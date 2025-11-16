@extends('layouts.app')
@section('title', 'داشبورد کاربر')

@section('content')
<div class="container py-4">
    <h3 class="fw-bold text-danger mb-4">خوش آمدی {{ $user->name }}</h3>

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
@endsection
