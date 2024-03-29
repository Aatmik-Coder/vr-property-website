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
                                <th>Property Name</th>
                                <th>Property Type</th>
                                <th>Property Size</th>
                                <th>Property Price</th>
                                <th>Action</th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@section('js')

<script src="{{ asset('assets/admin/js/property.js') }}"></script>
@stop
@endsection