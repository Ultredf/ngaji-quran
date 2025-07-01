<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="/dashboard" class="logo">
                <img src="{{ asset('assets/img/logo.svg') }}" alt="Logo" width="60%">
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <img src="{{ asset('assets/img/logo.svg') }}" alt="Logo" width="60%">
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>

            <li class="{{ Request::is('dashboard') ? 'active' : '' }}"><a class="nav-link" href="/dashboard"><i
                        class="far fa-square"></i>
                    <span>Dashboard</span></a>
            </li>

            @if (Auth::user()->role == 'admin')
                <li class="menu-header">Data User</li>
                <li class="{{ Request::is('user*') ? 'active' : '' }}"><a class="nav-link" href="/user"><i
                            class="far fa-user"></i>
                        <span>Data User</span></a></li>
                <li class="{{ Request::is('admin*') ? 'active' : '' }}"><a class="nav-link" href="/admin"><i
                            class="fas fa-user-shield"></i>
                        <span>Data Admin</span></a></li>
                <li class="{{ Request::is('data-verifikasi*') ? 'active' : '' }}"><a class="nav-link"
                        href="/data-verifikasi"><i class="fas fa-lock-open"></i>
                        <span>Data Verifikasi</span></a></li>
            @else
                <li class="menu-header">Data Kamu</li>
                <li class="{{ Request::is('verifikasi*') ? 'active' : '' }}"><a class="nav-link" href="/verifikasi"><i
                            class="fas fa-lock-open"></i>
                        <span>Verifikasi Akun</span></a></li>
            @endif
        </ul>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                <button type="submit" class="btn btn-primary btn-lg btn-block btn-icon-split">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </div>
        </form>

    </aside>
</div>
