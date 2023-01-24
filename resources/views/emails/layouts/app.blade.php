<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Password {!! Config::get('app.name') !!}</title>
</head>

<body style="margin:0; padding:0; font-size:15px; font-family:Arial, Helvetica, sans-serif; color:#000; background:#ddd;">

    <!-- <table align="center" cellspacing="0" cellpadding="0" width="600" border="0" style="background:-webkit-linear-gradient(left, #7730b4 0%,#8f32b0 25%,#bb36a8 68%,#cf37a4 100%); padding:0; background-size:100% 100%; background-color:#fff; font-family:Arial, Helvetica, sans-serif;"></table> -->
    <table align="center" cellspacing="0" cellpadding="0" width="600" border="0" style="padding:0; background-size:100% 100%; background-color:#1e449b; font-family:Arial, Helvetica, sans-serif;">
        <tr>
            <td align="center" style="padding:20px 0;width:100px;"><img src="{!! asset('assets/admin/images/logo.png') !!}?v=1" style="width:100px"></td>
        </tr>
        <tr>
            <td width="540px;" style="padding:0px 30px 20px;">

                @yield('content')

                <table cellspacing="0" cellpadding="0" width="100%" border="0" style="text-align:center; padding:0; border-radius:10px 10px 0 0; margin:0;font-size:12px;">
                    <tr>
                        <td align="center" style="padding:20px 0 0 0;"><p style="margin:0; font-family:Arial, Helvetica, sans-serif; color:#fff">Copyright &copy; {!! date('Y') !!}. All Rights Reserved. </p></td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>
</body>
</html>
