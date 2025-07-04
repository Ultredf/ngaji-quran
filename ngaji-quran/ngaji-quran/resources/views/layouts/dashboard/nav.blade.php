<div class="main-wrapper main-wrapper-1">

    <div class="navbar-bg"></div>

    <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
            <ul class="navbar-nav mr-3">
                <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a>
                </li>
                <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                            class="fas fa-search"></i></a></li>
            </ul>

        </form>

        <ul class="navbar-nav navbar-right">

            <li class="dropdown"><a href="#" data-toggle="dropdown"
                    class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    @if (Auth::user()->foto_profile == null)
                        <img alt="image" src="{{ asset('assets-dashboard/img/avatar/avatar-1.png') }}"
                            class="rounded-circle mr-1" style="object-fit: cover; object-position: center; width:2.5rem;height:2.5rem">
                    @else
                        <img alt="image" src="{{ asset(Auth::user()->foto_profile) }}"
                            class="rounded-circle mr-1" style="object-fit: cover; object-position: center; width:2.5rem;height:2.5rem">
                    @endif
                    <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-title">Logged in 5 min ago</div>
                    <a href="/profile" class="dropdown-item has-icon">
                        <i class="far fa-user"></i> Profile
                    </a>

                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                            <button type="submit" class="btn btn-danger btn-lg btn-block btn-icon-split">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </div>
                    </form>

                </div>
            </li>
        </ul>
    </nav>
</div>
