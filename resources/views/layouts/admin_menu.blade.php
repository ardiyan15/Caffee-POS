<aside class="main-sidebar custom-background sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
        {{-- <img src="{{ asset('dist/img/mandiri-logo-transparent.png') }}" class="center" alt="AdminLTE Logo"
            style="width: 150px; margin-left: 10%; opacity: .8"> --}}
        <span class="brand-text font-weight-light">Coffee Shop POS</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('home') }}"
                        class="nav-link @if ($menu == 'Dashboard') custom-active @else custom-color @endif"><i
                            class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">

                    <a href=""
                        class="nav-link @if ($menu == 'users') custom-active @else custom-color @endif"><i
                            class="nav-icon fa fa-user"></i>
                        <p>
                            User Profile
                        </p>
                    </a>
                </li>


                <li class="nav-item @if ($menu == 'mks') menu-open @endif">
                    <a href="#"
                        class="@if ($menu == 'mks') custom-active @else custom-color @endif nav-link">
                        <i class="nav-icon fa fa-list-alt"></i>
                        <p>
                            MKA
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href=""
                                class="@if ($sub_menu == 'scoring') active @else custom-color @endif nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Skoring MKA</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item @if ($menu == 'approval') menu-open @endif">
                    <a href="#"
                        class="@if ($menu == 'approval') custom-active @else custom-color @endif nav-link">
                        <i class="nav-icon fa fa-check"></i>
                        <p>
                            Approval
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href=""
                                class="@if ($sub_menu == 'approval_bi_checking') active @else custom-color @endif nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Approval BI Checking</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item @if ($menu == 'master') menu-open @endif">
                    <a href="#"
                        class="@if ($menu == 'master') custom-active @else custom-color @endif nav-link">
                        <i class="nav-icon fa fa-database"></i>
                        <p>
                            Data Master
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href=""
                                class="@if ($sub_menu == 'credit') active @else custom-color @endif nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pengajuan Kredit</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href=""
                                class="@if ($sub_menu == 'suku_bunga') active @else custom-color @endif nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Suku Bunga</p>
                            </a>
                        </li>
                    </ul>
                </li>
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
