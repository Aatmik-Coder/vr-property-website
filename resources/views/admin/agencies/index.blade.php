@extends('admin.layouts.app')
@section('content')
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                       <table class="table text-center" id="data-table">
                            <thead>
                                <th>Country</th>
                                <th>State</th>
                                <th>City</th>
                                <th>Project Name</th>
                                <th>Unit type</th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@section('js')

<script src="{{ asset('assets/admin/js/agency.js') }}"></script>
@stop
@endsection