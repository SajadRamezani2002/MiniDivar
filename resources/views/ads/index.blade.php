@extends('layouts.app')

@section('content')
    <h1>لیست آگهی‌ها</h1>

    @foreach($ads as $ad)
        <div class="card mb-3">
            <div class="card-body">
                <h3>{{ $ad->title }}</h3>
                <p>قیمت: {{ $ad->price }} تومان</p>
                <p>شهر: {{ $ad->city }}</p>
                <p>دسته: {{ $ad->category->name ?? '-' }}</p>
            </div>
        </div>
    @endforeach
@endsection
