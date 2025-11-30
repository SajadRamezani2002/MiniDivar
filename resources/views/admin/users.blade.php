@extends('layouts.admin')
@section('title', 'مدیریت کاربران')

@section('content')
<h3 class="fw-bold text-danger mb-4">کاربران</h3>

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
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone }}</td>
            <td>{{ $user->role }}</td>
            <td class="d-flex justify-content-center gap-2">
                {{-- فعال/غیرفعال --}}
                <form action="{{ route('admin.users.toggle', $user->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-warning btn-sm" type="submit">
                        {{ $user->role === 'banned' ? 'فعال کردن' : 'غیرفعال کردن' }}
                    </button>
                </form>

                {{-- ارتقا/تنزل --}}
                @if($user->id !== auth()->id() && $user->role !== 'banned')
                <form action="{{ route('admin.users.toggleRole', $user->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-success btn-sm" type="submit">
                        {{ $user->role === 'admin' ? 'تنزل به کاربر' : 'ارتقا به ادمین' }}
                    </button>
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $users->links() }}
</div>
@endsection
