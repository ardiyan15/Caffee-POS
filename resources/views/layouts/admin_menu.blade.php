<aside class="main-sidebar custom-background sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
        {{-- <img src="{{ asset('dist/img/mandiri-logo-transparent.png') }}" class="center" alt="AdminLTE Logo"
            style="width: 150px; margin-left: 10%; opacity: .8"> --}}
        <span class="brand-text font-weight-light">Coffee Shop POS</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if (Auth::user()->roles !== 'driver')
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}"
                            class="nav-link @if ($menu == 'Dashboard') active @endif"><i
                                class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('backoffice_report.index') }}"
                            class="nav-link @if ($menu == 'Report') active @endif"><i
                                class="nav-icon fas fa-file"></i>
                            <p>
                                Report
                            </p>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('backoffice_order.index') }}"
                        class="nav-link @if ($menu == 'Order') active @endif"><i
                            class="nav-icon fas fa-exchange-alt"></i>
                        <p>
                            Pesanan
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('profile.index') }}"
                        class="nav-link @if ($menu == 'profile') active @endif"><i
                            class="nav-icon fa fa-user"></i>
                        <p>
                            User Profile
                        </p>
                    </a>
                </li>
                @if (Auth::user()->roles !== 'driver')
                    <li class="nav-item @if ($menu == 'master') menu-open @endif">
                        <a href="#" class="@if ($menu == 'master') active @endif nav-link">
                            <i class="nav-icon fa fa-database"></i>
                            <p>
                                Data Master
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{ route('products.index') }}"
                                    class="@if ($sub_menu == 'produk') active @endif nav-link ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Produk</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('users.index') }}"
                                    class="@if ($sub_menu == 'user') active @endif nav-link ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>User</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                <hr color="white" width="200px;">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <li class="nav-item">
                        <button class="btn btn-sm nav-link text-left font-weight-bold text-mute" style="width: 100%;">
                            <i class="fas fa-sign-out-alt custom-color"></i>
                            <p class="custom-color">
                                Logout
                            </p>
                        </button>
                    </li>
                </form>
            </ul>
        </nav>
    </div>
</aside>
