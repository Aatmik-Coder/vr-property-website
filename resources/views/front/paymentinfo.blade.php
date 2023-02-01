@extends('front.layouts.app')
@section('content')

<div class="login-sec payment-sec">
    <div class="container">
        <div class="payment-card">
            <h3 class="title">
                @if(auth('web')->check())
                Upload an Image
                @else
                Sign Up for Free
                @endif
            </h3>
            <h2>{!! config('constants.CURRENCY_SYMBOL').config('constants.IMAGE_UPLOAD_PRICE') !!}</h2>
            <span>per upload</span>
            @if(auth('web')->check())
            <a href="{!! route('image.add') !!}" class="btn btn-gradient">Upload an Image</a>
            @else
            <a href="{!! route('register') !!}" class="btn btn-gradient">Sign Up</a>
            @endif
            <ul>
                <li>Each upload just {!! config('constants.CURRENCY_SYMBOL').config('constants.IMAGE_UPLOAD_PRICE') !!}</li>
                <li>Powerful organisation tools for your images.</li>
                <li>Add image keywords.</li>
                <li>Tag your images so that they come up first in search.</li>
                <li>Image exposure to the world wibe web and all devices tuned in to Flyerbureau</li>
            </ul>
        </div>
        <div class="content">
            <p>*Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
            <p>*Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>
        </div>
    </div>
</div>

@endsection
@section('js')
@stop
