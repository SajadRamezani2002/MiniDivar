{{-- این تگ استایل، تمام استایل‌های لازم را مستقیماً در این فایل تعریف می‌کند --}}
<style>
    .main-navbar {
        background-color: #1a1a1a !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
        border-bottom: 1px solid #333 !important;
    }

    .main-navbar .navbar-brand {
        font-size: 1.5rem;
        font-weight: 700;
        color: #ffffff !important;
    }

    .main-navbar .nav-link {
        color: rgba(255, 255, 255, 0.8) !important;
        margin-left: 1rem;
        transition: color 0.3s ease;
        position: relative;
    }

    .main-navbar .nav-link:hover {
        color: #ffffff !important;
    }

    .main-navbar .nav-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: -5px;
        right: 0;
        background-color: #dc3545;
        transition: width 0.3s ease;
    }

    .main-navbar .nav-link:hover::after {
        width: 80%;
    }

    .main-navbar .user-dropdown img {
        border: 2px solid #dc3545;
    }

    .main-navbar .dropdown-menu {
        border: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        border-radius: 0.5rem;
    }

    .btn-post-ad {
        background-color: #28a745 !important;
        border-color: #28a745 !important;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-post-ad:hover {
        background-color: #218838 !important;
        border-color: #1e7e34 !important;
        transform: translateY(-2px);
    }

    .main-navbar .btn-outline-light {
        border-color: rgba(255,255,255,0.5) !important;
        color: rgba(255,255,255,0.9) !important;
    }

    .main-navbar .btn-outline-light:hover {
        border-color: #ffffff !important;
        background-color: #ffffff !important;
        color: #1a1a1a !important;
    }
</style>

<nav class="navbar navbar-expand-lg main-navbar navbar-dark sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('ads.index') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="me-2" style="width: 50px; height: 50px; object-fit: contain;">
            MiniDivar
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMiniDivar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMiniDivar">
            <ul class="navbar-nav ms-auto align-items-center">

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">ورود</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="btn btn-danger btn-sm" href="{{ route('register') }}">ثبت‌نام</a>
                    </li>
                @endguest

                @auth
                    <li class="nav-item d-flex align-items-center gap-2">
                        <a href="{{ route('ads.create') }}" class="btn btn-danger btn-sm">
                            <i class="bi bi-plus-circle ms-1"></i> ثبت آگهی
                        </a>
                    </li>

                    <li class="nav-item dropdown user-dropdown ms-3">
                        <a class="nav-link dropdown-toggle d-flex align-items-center text-white"
                           href="#" id="navbarDropdown"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ Auth::user()->profile_photo_url ?? asset('images/user.png') }}"
                                 class="rounded-circle me-2" width="32" height="32" style="object-fit: cover;">
                            {{ Auth::user()->name }}
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end text-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('dashboard') }}">
                                    <i class="bi bi-speedometer2 ms-2"></i> داشبورد
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="{{ route('profile.show') }}">
                                    <i class="bi bi-person ms-2"></i> پروفایل
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="{{ route('my.ads') }}">
                                    <i class="bi bi-card-text ms-2"></i> آگهی‌های من
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="{{ route('chat.index') }}">
                                    <i class="bi bi-chat-dots ms-2"></i> مشاهده پیام‌ها
                                </a>
                            </li>

                            {{-- فقط برای ادمین --}}
                            @if(auth()->user()->role === 'admin')
                                <li><hr class="dropdown-divider"></li>

                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.ads') }}">
                                        <i class="bi bi-list-ul ms-2"></i> مدیریت آگهی‌ها
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.users') }}">
                                        <i class="bi bi-people-fill ms-2"></i> مدیریت کاربران
                                    </a>
                                </li>
                            @endif

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right ms-2"></i> خروج
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>
