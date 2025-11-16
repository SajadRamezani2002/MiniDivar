<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">

        {{-- لوگو --}}
        <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
            <img src="{{ asset('images/logo.png') }}" alt="MiniDivar" height="28" class="me-2">
            MiniDivar
        </a>

        {{-- دکمه باز/بستن در موبایل --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- منو --}}
        <div class="collapse navbar-collapse" id="mainNav">

            {{-- منوی سمت راست --}}
            <ul class="navbar-nav ms-auto">

                {{-- لینک صفحه اصلی --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('ads.index') ? 'active' : '' }}" href="{{ route('ads.index') }}">
                        <i class="bi bi-house"></i> خانه
                    </a>
                </li>

                {{-- لینک ثبت آگهی --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('ads.create') ? 'active' : '' }}" href="{{ route('ads.create') }}">
                        <i class="bi bi-plus-circle"></i> ثبت آگهی
                    </a>
                </li>

                {{-- اگر کاربر لاگین نکرده --}}
                @guest
                    <li class="nav-item ms-2">
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm px-3">ورود</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a href="{{ route('register') }}" class="btn btn-danger btn-sm px-3">ثبت‌نام</a>
                    </li>
                @endguest

                {{-- اگر کاربر لاگین کرده --}}
                @auth
                    <li class="nav-item dropdown ms-3">
                        <a class="nav-link dropdown-toggle d-flex align-items-center text-white" href="#" id="userMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ Auth::user()->profile_photo_url ?? asset('images/user.png') }}"
                                 class="rounded-circle me-2" width="30" height="30" alt="User">
                            {{ Auth::user()->name }}
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                            <li>
                                <a class="dropdown-item" href="{{ route('dashboard') }}">
                                    <i class="bi bi-speedometer2"></i> داشبورد
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.show') }}">
                                    <i class="bi bi-person"></i> پروفایل
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right"></i> خروج
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
