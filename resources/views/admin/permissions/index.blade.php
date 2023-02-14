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
                                <th>id</th>
                                <th>Permission Name</th>
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

<script src="{{ asset('assets/admin/js/permission.js') }}"></script>
@stop
@endsection
