<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ asset('AdminLTE') }}/index3.html" class="brand-link">
        <img src="https://media.tenor.com/VtFUW-durpoAAAAC/kururin-kuru-kuru.gif"
            class="brand-image img-circle elevation-3" alt="" width="35" height="35">
        <span class="brand-text font-weight-bolder">Admin Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('AdminLTE') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                {{-- Menu --}}
                <li class="nav-item {{ Request::is('dashboard') ? 'menu-open' : '' }}">
                    <div class="nav-link">
                        {{-- <i class="nav-icon fas fa-bars"></i> --}}
                        <p>
                            Menu
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </div>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/dashboard" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Home</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ asset('AdminLTE') }}/pages/kanban.html" class="nav-link">
                                <i class="nav-icon fas fa-exclamation-circle"></i>
                                <p>
                                    About
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Posts --}}
                <li class="nav-item {{ Request::is('dashboard/posts*') ? 'menu-open' : '' }}">
                    <div class="nav-link">
                        <p>
                            Posts
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </div>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/dashboard/posts"
                                class="nav-link {{ Request::is('dashboard/posts*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Posts
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/posts" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    See as User
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- gates --}}
                @can('admin')
                {{-- Administrator --}}
                <li class="nav-item {{ Request::is('dashboard/categories*') ? 'menu-open' : '' }}">
                    <div class="nav-link">
                        <p>
                            Administrator
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </div>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/dashboard/categories"
                                class="nav-link {{ Request::is('dashboard/categories*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tags"></i>
                                <p>
                                    Category
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan

                {{-- Account --}}
                <li class="nav-item">
                    <div class="nav-link">
                        <p>
                            Account
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </div>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ asset('AdminLTE') }}/pages/kanban.html" class="nav-link">
                                <i class="nav-icon fas fa-envelope"></i>
                                <p>
                                    Message
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ asset('AdminLTE') }}/pages/kanban.html" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Profile
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <form action="/logout" method="post">
                                @csrf
                                <button type="submit" class="btn btn-text nav-link btn-danger mt-4"><i
                                        class="nav-icon fas fa-sign-out-alt"></i>Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
