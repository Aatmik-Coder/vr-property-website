@extends('admin.layouts.app')
@section('content')
<!-- Dashboard Counts Section-->
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <!-- Form Elements -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form id="profileFrm" name="profileFrm" action="{!! route('admin.permissions.store') !!}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">create new permission</label>
                                <div class="col-sm-9">
                                    <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="enter permission">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="line"> </div>
                            <div class="form-group row">
                                <div class="col-sm-4 offset-sm-3">
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                    <button type="button" class="btn btn-secondary" onclick="location.href='{{ URL('/admin') }}';">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@section('js')
<script src="{{ asset('assets/admin/js/auth.js') }}"></script>
@stop
@endsection
