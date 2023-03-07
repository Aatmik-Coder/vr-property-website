<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<script src="{!! asset('assets/common/js/jquery.min.js') !!}"></script>
<style>
    body{
        margin: 0;
        padding: 0;
        overflow: hidden;
    }
    #ext_link{
        width: 100%;
        height:700px;
    }
</style>
<body>
    <iframe src="
        @if (\Carbon\Carbon::parse($get_virtual_info->demo_time)->format('Y-m-d H:i:s') > now($get_virtual_info->timezone))
            {!! route(Request::segment('1').'.not-started') !!}
        @else   
            @if(\Carbon\Carbon::parse($get_virtual_info->expiry_time)->format('Y-m-d H:i:s') > now($get_virtual_info->timezone)) 
                {!! $get_virtual_info->actual_link !!} 
            
            @else
                {!! route(Request::segment('1').'.ended') !!}
            @endif
        @endif" frameborder="0" id="ext_link"></iframe>
</body>
<script>
    $(document).ready(function(){
        let expiry_time = "{!! $get_virtual_info->expiry_time !!}";
        // let demo_time = "{!! $get_virtual_info->demo_time !!}";
        let refresh = setTimeout(() => {
            $('#ext_link').load();
        }, expiry_time);
    });
</script>
</html>