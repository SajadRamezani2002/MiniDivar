@extends('layouts.app')

@section('title', 'لیست آگهی‌ها')

@section('content')
    <h1 class="mb-4 fw-bold text-primary">آخرین آگهی‌ها</h1>

    @foreach($ads as $ad)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">{{ $ad->title }}</h5>
                <p class="card-text">قیمت: {{ number_format($ad->price) }} تومان</p>
                <p class="card-text">شهر: {{ $ad->city }}</p>
                <p class="card-text">دسته: {{ $ad->category->name ?? '-' }}</p>

                <a href="{{ route('ads.show', $ad->id) }}" class="btn btn-primary btn-sm mt-2">
                    مشاهده آگهی
                </a>
            </div>
        </div>
    @endforeach

    <div class="mt-3">
        {{ $ads->links() }}
    </div>
@endsection
