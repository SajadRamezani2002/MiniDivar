<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MiniDivar')</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Bootstrap Local --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.rtl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    @livewireStyles
    @stack('styles')
</head>
<body>

    {{-- هدر مشترک --}}
    @include('layouts.header')

    <div class="d-flex flex-nowrap">
        {{-- این بخش برای نمایش سایدار ادمین است --}}
        @hasSection('adminSidebar')
            @yield('adminSidebar')
        @endif

        {{-- محتوای اصلی سایت --}}
        <main class="main-content-wrapper flex-grow-1">
            @if(session('success'))
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    {{-- فوتر --}}
    @include('layouts.footer')

    {{-- Bootstrap Local --}}
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    @livewireScripts
    @stack('scripts')
</body>
</html>
