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
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Nickname</th>
                                <th>Buisness Name</th>
                                <th>Is Active?</th>
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

<script src="{{ asset('assets/admin/js/user.js') }}"></script>
@stop
@endsection
