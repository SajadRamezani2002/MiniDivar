@extends('layouts.admin')
@section('title', 'مدیریت آگهی‌ها')

@section('content')
<h3 class="fw-bold text-danger mb-4">آگهی‌ها</h3>

<div class="table-responsive">
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
        @foreach($ads as $ad)
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
<div class="d-flex justify-content-center">
    {{ $ads->links() }}
</div>
</div>
@endsection
