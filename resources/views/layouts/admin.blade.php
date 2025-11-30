<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'پنل مدیریت') | MiniDivar</title>

    {{-- Bootstrap Local --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.rtl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>
<body class="bg-light">

<div class="d-flex flex-row-reverse">
    {{-- Sidebar راست --}}
    <nav class="bg-dark text-white p-3 vh-100" style="width: 240px;">
        <h4 class="text-center mb-4">پنل مدیریت</h4>
        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a href="{{ route('admin.dashboard') }}" class="nav-link text-white">
                    <i class="bi bi-speedometer2"></i> داشبورد
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('admin.ads') }}" class="nav-link text-white">
                    <i class="bi bi-card-text"></i> آگهی‌ها
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('admin.users') }}" class="nav-link text-white">
                    <i class="bi bi-people"></i> مدیریت کاربران
                </a>
            </li>
            <li class="nav-item mt-3 border-top pt-3">
                <a href="{{ route('logout') }}" class="nav-link text-white">
                    <i class="bi bi-box-arrow-right"></i> خروج
                </a>
            </li>
        </ul>
    </nav>

    {{-- Main Content --}}
    <main class="flex-grow-1 p-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @yield('content')
    </main>
</div>

{{-- Bootstrap Local --}}
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
