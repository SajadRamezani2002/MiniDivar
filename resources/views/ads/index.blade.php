@extends('layouts.app')

@section('title', 'صفحه اصلی - MiniDivar')

@section('content')
<div class="container py-5">

    <h2 class="fw-bold text-center mb-5">آخرین آگهی‌ها</h2>

    <div class="row">
        @forelse($ads as $ad)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    {{-- تصویر --}}
                    @if($ad->images->isNotEmpty())
                        <img src="{{ asset('storage/' . $ad->images->first()->file_path) }}" class="card-img-top" alt="تصویر آگهی" style="height: 200px; object-fit: cover;">
                    @else
                        <img src="{{ asset('images/no-image.png') }}" class="card-img-top" alt="بدون تصویر" style="height: 200px; object-fit: cover;">
                    @endif

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $ad->title }}</h5>
                        <p class="text-muted small mb-2">{{ number_format($ad->price) }} تومان | {{ $ad->city }}</p>

                        <p class="mt-2 card-text text-truncate">{{ $ad->description }}</p>
                        <a href="{{ route('ads.show', $ad->id) }}" class="btn btn-danger mt-auto">مشاهده جزئیات</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-muted">فعلاً هیچ آگهی ثبت نشده است.</p>
        @endforelse
    </div>

    Pagination
    <div class="d-flex justify-content-center mt-4">
        {{ $ads->links() }}
    </div>

</div>
@endsection
