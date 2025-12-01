<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'پنل مدیریت') | MiniDivar</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet" integrity="sha384-nU4brbapRxaI3G6g9sCzFh+1S2OqQ9M7wTcRZfUO8Xj4P+I6IwF7fKJkfUI1KjTlPb9Jn4zGhP" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    @livewireStyles
    @stack('styles')
</head>
<body class="bg-light">

<div class="d-flex">
    <!-- Sidebar راست -->
    <nav class="bg-dark text-white p-3" style="width: 250px; min-height: 100vh;">
        <h4 class="text-center mb-4">پنل مدیریت</h4>
        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a href="{{ route('admin.dashboard') }}" class="nav-link text-white {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2 ms-2"></i> داشبورد
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('admin.ads') }}" class="nav-link text-white {{ request()->routeIs('admin.ads*') ? 'active' : '' }}">
                    <i class="bi bi-card-text ms-2"></i> آگهی‌ها
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('admin.users') }}" class="nav-link text-white {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                    <i class="bi bi-people ms-2"></i> مدیریت کاربران
                </a>
            </li>
            <li class="nav-item mt-3 border-top pt-3">
                <a href="{{ route('logout') }}" class="nav-link text-white" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right ms-2"></i> خروج
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>

    <!-- Main Content -->
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

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcVlmQzl9Ws1NU7DRjW1xIY85aE=" crossorigin="anonymous"></script>
@livewireScripts
@stack('scripts')
</body>
</html>
