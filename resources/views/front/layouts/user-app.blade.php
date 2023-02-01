<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{!! (isset($title) ? $title." | " : "").config('app.name') !!}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="all,follow">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}?v=1">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">

    @yield('css')
    <link rel="stylesheet" href="{{ asset('assets/common/css/all.css') }}">

    @if(auth('web')->check())
    <link rel="stylesheet" href="{{ asset('assets/front/css/user.css') }}?v={{time()}}" id="theme-stylesheet">
    @else
    <link rel="stylesheet" href="{{ asset('assets/front/css/style.css') }}?v={{time()}}" id="theme-stylesheet">
    @endif
    <!-- Tweaks for older IEs-->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<body>
    <div class="loader" style="display:none"><span class="loader-image"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></span></div>

    <header class="user-header">
        <div class="header-logo-sec">
            <a href="#" class="navbar-brand">
                <img src="{{ asset('assets/common/images/logo.png') }}" class="img-fluid logo" alt="logo" />
            </a>
            <div class="content">
                <img src="{{ auth('admin')->user()->avatar_url }}" class="user-img" />
                <a id="toggle-btn" href="#" class="menu-btn">
                    <img src="{{ asset('assets/common/images/menu-icon.png') }}" class="menu-icon" />
                </a>
            </div>
        </div>
        <ul class="nav ms-auto">
            <li class="nav-item">
                <a href="#" class="nav-link">Images Uploaded: 12</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Images Active: <span>4</span></a>
            </li>
            <li class="nav-item">
                <a href="{{ route('home') }}" class="btn btn-gradient px-4">Back to Home</a>
            </li>
        </ul>
    </header>
    <div class="users-body">
        <div class="siderbar">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">My Images</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">Upload Images</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Your Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Profile Preview</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Help & How To</a>
                </li>
                <li class="nav-item logout-item">
                    <a class="nav-link" href="#">Log Out</a>
                </li>
            </ul>
        </div>
        <div class="ubody-content">
            @yield('content')
        </div>
    </div>



    <script src="{{ asset('assets/common/js/all.js') }}"></script>
    <!-- Main File-->
    <script>
    var _token = $("input[name='_token']").val();
    var baseUrl = "{{ url('admin').'/' }}";
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
