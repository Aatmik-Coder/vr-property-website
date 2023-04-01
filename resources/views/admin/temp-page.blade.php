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
    html, body {
        height: 100%;
    }
    body{
        margin: 0;
        padding: 0;
        overflow: hidden;
    }
    #ext_link{
        width: 100%;
        height:100%;
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
        @endif" frameborder="0" id="ext_link" allow="camera; microphone"></iframe>
</body>
<script>
    $(document).ready(function() {
        var demo_time = "{!! $get_virtual_info->demo_time !!}";
        var expiry_time = "{!! $get_virtual_info->expiry_time !!}";

        setInterval(() => {
            function addZero(i) {
                if (i < 10) {i = "0" + i}
                return i;
            }

            const d = new Date();
            let h = addZero(d.getHours());
            let m = addZero(d.getMinutes());
            let s = addZero(d.getSeconds());
            let time = h + ":" + m + ":" + s;
            
            if(time == demo_time){
               location.reload();
            }
            if(time == expiry_time) {
                location.reload();
            }
        }, 1000);
    })
</script>
</html>