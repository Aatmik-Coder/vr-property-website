@extends('front.layouts.app')
@section('content')

<div class="relative flex items-top justify-center min-h-screen bg-gray-100 sm:items-center py-4 sm:pt-0">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
            <h1>Welcome to {!! config('app.name') !!}</h1>
        </div>
    </div>
</div>

<!-- JavaScript files-->
@section('js')
<script src="{{ asset('assets/front/js/auth.js') }}"></script>
@stop
@endsection