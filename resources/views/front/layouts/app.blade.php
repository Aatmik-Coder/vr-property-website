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
    <link rel="stylesheet" href="{{ asset('assets/front/css/style.css') }}?v={{time()}}" id="theme-stylesheet">
    <!-- Tweaks for older IEs-->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<body>
    <div class="loader" style="display:none"><span class="loader-image"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></span></div>

    <nav class="main-navbar navbar navbar-expand-lg">
        <div class="container">
            @if(request()->routeIs('login'))
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="btn btn-black px-4 border-gradient">Back to Home</a>
                    </li>
                </ul>
            </div>
            @elseif(request()->routeIs('password.request') || request()->routeIs('password.reset'))
            <div class="navbar-brand">
                <a href="{{ route('home') }}" class="btn btn-black px-4 border-gradient">Back to Home</a>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-outline-gradient">Log In</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-black border-gradient">Sign Up</a>
                    </li>
                </ul>
            </div>
            @elseif(request()->routeIs('register'))
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-outline-gradient">Log In</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="btn btn-black px-4 border-gradient">Back to Home</a>
                    </li>
                </ul>
            </div>
            @else
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('assets/common/images/logo-colored.png') }}" class="img-fluid logo" alt="logo-colored" />
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    @if(auth('web')->check())
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-black">Dashboard</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-outline-gradient">Log in</a>
                    </li>
                    @endauth
                    <li class="nav-item menu-btn-item">
                        <button class="btn menu-btn">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                    </li>
                </ul>
            </div>
            @endif
        </div>
    </nav>

    @yield('content')

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <a class="navbar-brand" href="{{ route('dashboard') }}">
                        <img src="{{ asset('assets/common/images/logo.png') }}" class="img-fluid logo" alt="logo" />
                    </a>
                </div>
                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-lg-4">
                            <a href="javascript:void(0)" class="f-links">Cookies</a>
                            <a href="javascript:void(0)" class="f-links">Terms & Conditions</a>
                            <a href="javascript:void(0)" class="f-links">Privacy Policy</a>
                        </div>
                        <div class="col-lg-4">
                            <a href="{!! route('home') !!}" class="f-links">Home</a>
                            <a href="{!! route('image.add') !!}" class="f-links">Upload Images</a>
                            @guest
                            <a href="{!! route('register') !!}" class="f-links">Sign Up</a>
                            @endguest
                            <a href="javascript:void(0)" class="f-links">About Us</a>
                            <a href="javascript:void(0)" class="f-links">Contact Us</a>
                            <a href="{!! route('payment-info') !!}" class="f-links">Pricing</a>
                        </div>
                        <div class="col-lg-4">
                            <h6 class="title">Follow Us</h3>
                            <div class="social-row">
                                <a href="javascript:void(0)" class="social-btn-white"><i class="fab fa-instagram"></i></a>
                                <a href="javascript:void(0)" class="social-btn-white bottom"><i class="fab fa-facebook-f"></i></a>
                                <a href="javascript:void(0)" class="social-btn-white bottom"><i class="fab fa-pinterest-p"></i></a>
                                <a href="javascript:void(0)" class="social-btn-white"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-5">
                    <p class="copyright-line">Flyer Bureau Company Info</p>
                </div>
            </div>
        </div>
    </footer>

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
