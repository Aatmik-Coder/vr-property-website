<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{!! request()->segment(2) !!}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="all,follow">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}?v=1">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <link rel="stylesheet" href="{{ asset('assets/common/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}?v={{time()}}" id="theme-stylesheet">
    {{-- <link rel="stylesheet" href="{{ asset('assets/admin/css') }}" --}}

    <!-- Tweaks for older IEs-->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]--> 
</head>

<body>
    <div class="loader" style="display:none"><span class="loader-image"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></span></div>
    @if(auth(Request::segment(1))->check())
    <div class="page">
        <!-- Main Navbar-->
        <header class="header">
            <nav class="navbar">
                <div class="container-fluid px-0">
                    <div class="navbar-holder d-flex align-items-center justify-content-between">
                        <!-- Navbar Header-->
                        <div class="navbar-header">
                            <!-- Navbar Brand -->
                            <a href="{{ route('admin.dashboard') }}" class="navbar-brand d-none d-sm-inline-block">
                                <div class="brand-text d-none d-lg-inline-block">
                                    <img src="{{ asset('assets/common/images/logo.png') }}" class="logo-img">
                                    <!-- <strong>Dashboard</strong> -->
                                </div>
                                <div class="brand-text d-none d-sm-inline-block d-lg-none">
                                    <strong>VD</strong>
                                </div>
                            </a>
                            <div>
                                {{-- <img src="{{ auth('admin')->user()->avatar_url }}" class="user-img" /> --}}
                                <a id="toggle-btn" href="#" class="menu-btn">
                                    <img src="{{ asset('assets/common/images/menu-icon.png') }}" class="menu-icon" />
                                </a>
                            </div>
                        </div>
                        <!-- Navbar Menu -->
                        <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                            <!-- Settings dropdown    -->
                            <li class="nav-item dropdown">
                                <a id="settings" rel="nofollow" data-target="#" href="#" data-bs-toggle="dropdown" aria-expanded="false" class="nav-link language dropdown-toggle">
                                    <i class="fa fa-cog"></i><span class="d-none d-sm-inline-block"></span>Settings
                                </a>
                                <ul aria-labelledby="settings" class="dropdown-menu">
                                    <li>
                                        <a rel="nofollow" href="{{ route('admin.profile.edit') }}" class="dropdown-item">Manage Profile</a>
                                    </li>
                                    <li>
                                        <a rel="nofollow" href="{{ route('admin.password.edit') }}" class="dropdown-item">Change Password</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- Logout    -->
                            <li class="nav-item">
                                <!-- <a href="#" onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();" class="nav-link logout"> -->
                                <a href="#" onclick="logout()" class="nav-link logout">
                                <span class="d-none d-sm-inline">Logout</span><i class="fa fa-sign-out"></i></a>
                            </li>
                            <form id="logout-form" action="{{ route(Request::segment(1).'.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div class="page-content d-flex align-items-stretch" id="app">
            @include("admin.layouts.navigation")
            <div class="content-inner">
                <!-- Page Header-->
                <header class="page-header">
                    <div class="container-fluid">
                        <h2 class="no-margin-bottom">{{ strtoupper(request()->segment(2))}}</h2>
                    </div>
                </header>
                @yield('content')
                <footer class="main-footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <p>{{ config('app.name')}} &copy; {{date('Y')}}</p>
                            </div>
                            <div class="col-sm-6 copyrights text-right">
                                <p>Design by <a href="{!! url('/') !!}" target="_blank">{{ config('app.name')}}</a></p>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    <!-- JavaScript files-->
    @else
    @yield('content')
    @endif
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/common/js/all.js') }}"></script>
    
    <!-- Main File-->
    <script>
    var _token = $("input[name='_token']").val();
    var baseUrl = "{{ url(Request::segment(1)).'/' }}";
    var emsg = "";
    var ecls = "success";
    @if(session('message') || session('status'))
    emsg = "{{ @session('message').@session('status') }}";
    @if(session('alert-class') && session('alert-class') == "error")
    ecls = "error";
    @endif
    @endif
    </script>
    <script src="{{ asset('assets/common/js/common.js') }}"></script>
    @yield('js')
</body>

</html>
