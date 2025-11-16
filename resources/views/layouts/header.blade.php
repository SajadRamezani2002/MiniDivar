<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand fw-bold" href="{{ route('ads.index') }}">
      <img src="{{ asset('images/logo.png') }}" alt="Logo" class="me-2"> MiniDivar
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMiniDivar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarMiniDivar">
      <ul class="navbar-nav ms-auto align-items-center">

        {{-- <li class="nav-item"><a href="{{ route('ads.index') }}" class="nav-link">خانه</a></li> --}}


        {{-- اگر کاربر مهمان است --}}
        @guest
          <li class="nav-item ms-3">
            <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">ورود</a>
          </li>
          <li class="nav-item ms-2">
            <a href="{{ route('register') }}" class="btn btn-danger btn-sm">ثبت‌نام</a>
          </li>
        @endguest

        {{-- اگر کاربر لاگین کرده --}}
        @auth
          <li class="nav-item dropdown ms-3">
            <li class="nav-item"><a href="{{ route('ads.create') }}" class="nav-link">ثبت آگهی</a></li>
            <a class="nav-link dropdown-toggle text-white d-flex align-items-center" href="#" data-bs-toggle="dropdown">
              <img src="{{ Auth::user()->profile_photo_url ?? asset('images/user.png') }}" class="rounded-circle me-2" width="32" height="32">
              {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end text-end">
              <li><a class="dropdown-item" href="{{ route('dashboard') }}">داشبورد</a></li>
              <li><a class="dropdown-item" href="{{ route('profile.show') }}">پروفایل</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button class="dropdown-item text-danger">خروج</button>
                </form>
              </li>
            </ul>
          </li>
        @endauth

      </ul>
    </div>
  </div>
</nav>
