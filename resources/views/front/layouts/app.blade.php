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
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <link rel="stylesheet" href="{{ asset('assets/common/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/style.css') }}?v={{time()}}" id="theme-stylesheet">

    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<body>
    <div class="loader" style="display:none"><span class="loader-image"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></span></div>
    @yield('content')

    <script src="{{ asset('assets/common/js/all.js') }}"></script>
    <!-- Main File-->
    <script>
        var _token = $("input[name='_token']").val();
        var baseUrl = "{{ url('admin').'/' }}";
        var emsg = "";
        var ecls = "success";
        @if (session('message') || session('status'))
            emsg = "{{ @session('message').@session('status') }}";
            @if (session('alert-class') && session('alert-class') == "error")
                ecls = "error";
            @endif
        @endif
    </script>
    <script src="{{ asset('assets/common/js/common.js') }}"></script>
    @yield('js')
</body>
</html>
