<!-- Preloader -->
{{-- <div class="preloader flex-column justify-content-center align-items-center"> --}}
{{-- <img class="animation__shake" src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60"> --}}
{{-- </div> --}}

<nav class="main-header navbar navbar-expand navbar-white navbar-light justify-content-between">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <h6>{{ '[ ' . strtoupper(Auth::user()->username) . ' - ' . strtoupper(Auth::user()->roles) . ' ]' }}
    </h6>
</nav>
