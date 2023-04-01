@extends('admin.layouts.app')
@section('content')
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                       <table class="table text-center" id="data-table-upcoming-meeting">
                            <thead>
                                <th>name</th>
                                <th>email</th>
                                <th>phone number</th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@section('js')
<script src="{{ asset('assets/admin/js/employee2.js') }}"></script>
@stop
@endsection