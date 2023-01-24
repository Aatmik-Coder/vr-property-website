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
                        <form id="profileFrm" name="profileFrm" action="{{ route('admin.profile.update') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">Name</label>
                                <div class="col-sm-9">
                                    <input id="name" name="name" type="text" class="form-control" value="{{ old('name') ?? $admin->name }}">
                                </div>
                            </div>
                            <div class="line"></div>
                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">Email</label>
                                <div class="col-sm-9">
                                    <input id="email" name="email" type="text" class="form-control" value="{{ old('email') ?? $admin->email }}">
                                </div>
                            </div>
                            <div class="line"></div>
                            <div class="form-group row">
                                <label for="fileInput" class="col-sm-3 form-control-label">Photo</label>
                                <div class="col-sm-3">
                                    <input id="image" name="image" type="file" class="form-control-file" accept="image/*">
                                </div>
                                <div class="col-md-3">
                                    <img src="{{ $admin->avatar_url }}" class="img-thumbnail" width="70" height='70' id='image_preview'>
                                </div>
                            </div>
                            <div class="line"> </div>
                            <div class="form-group row">
                                <div class="col-sm-4 offset-sm-3">
                                    <button type="button" class="btn btn-secondary" onclick="location.href='{{ URL('/admin') }}';">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
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
