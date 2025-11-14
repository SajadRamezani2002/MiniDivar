<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">

        {{-- Logo --}}
        <a class="navbar-brand fw-bold" href="{{ route('ads.index') }}">
            MiniDivar
        </a>

        {{-- Mobile Toggle --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMain">

            <ul class="navbar-nav ms-auto">

                {{-- اگر کاربر لاگین نیست --}}
                @guest
                    <li class="nav-item">
                        <a class="btn btn-success px-3" href="{{ route('login') }}">
                            ورود
                        </a>
                    </li>
                @endguest

                {{-- اگر کاربر لاگین است --}}
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-bold text-light" href="#"
                           id="userDropdown" role="button" data-bs-toggle="dropdown">
                            {{ auth()->user()->name }}
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('dashboard') }}">
                                    داشبورد
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    پروفایل
                                </a>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item text-danger">
                                        خروج
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
