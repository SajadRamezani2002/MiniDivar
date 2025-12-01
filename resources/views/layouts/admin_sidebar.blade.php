<nav class="admin-sidebar" id="adminSidebar">
    <div class="sidebar-header">
        <h4 class="fw-bold">پنل مدیریت</h4>
    </div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 ms-2"></i> داشبورد
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.ads') }}" class="nav-link {{ request()->routeIs('admin.ads*') ? 'active' : '' }}">
                <i class="bi bi-card-text ms-2"></i> آگهی‌ها
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.users') }}" class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                <i class="bi bi-people ms-2"></i> مدیریت کاربران
            </a>
        </li>
        <li class="nav-item mt-auto pt-3 border-top">
            <a href="{{ route('logout') }}" class="nav-link text-danger-light" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right ms-2"></i> خروج
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</nav>
