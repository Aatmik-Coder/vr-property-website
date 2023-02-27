@extends('admin.layouts.app')

@section('content')

<h1>Hi {!! $employee->person_name !!}, You're logged in!</h1>
<!-- JavaScript files-->
@section('js')

@stop
@endsection
