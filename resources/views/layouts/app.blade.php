<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MiniDivar')</title>

    {{-- Bootstrap Local --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.rtl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    @livewireStyles
</head>
<body>

    {{-- هدر مشترک --}}
    @include('layouts.header')

    <main class="container py-4 min-vh-100">
        @yield('content')
    </main>

    {{-- فوتر --}}
    @include('layouts.footer')

    {{-- Bootstrap Local --}}
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    @livewireScripts
</body>
</html>
