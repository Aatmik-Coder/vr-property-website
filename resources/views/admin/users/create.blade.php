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
                        <form id="profileFrm" name="profileFrm" action="{!! route('admin.users.store') !!}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label" for="roles">Role</label>
                                <div class="col-sm-9">
                                    <select name="role_id" id="role_id" class="form-control">
                                        <option value="">Select</option>
                                        <option value="Super Admin">Super Admin</option>
                                        <option value="Developer">Developer</option>
                                        <option value="Employee">Employee</option>
                                        <option value="Agency">Agency</option>
                                    </select>
                                    {{-- <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ?? $admin->name }}"> --}}
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">Name</label>
                                <div class="col-sm-9">
                                    <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="enter name">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">Email</label>
                                <div class="col-sm-9">
                                    <input id="email" name="email" type="text" class="form-control @error('email') is-invalid @enderror" placeholder="enter email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">Mobile</label>
                                <div class="col-sm-9">
                                    <input id="mobile" name="mobile" type="number" class="form-control @error('mobile') is-invalid @enderror" placeholder="enter mobile number" min="1">
                                    @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">Password</label>
                                <div class="col-sm-9">
                                    <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="enter password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="fileInput" class="col-sm-3 form-control-label">Photo</label>
                                <div class="col-sm-3">
                                    <input id="image" name="image" type="file" class="form-control-file @error('image') is-invalid @enderror" accept="image/*" value="upload">
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    {{-- <img src="{{ $admin->avatar_url }}" class="img-thumbnail" width="70" height='70' id='image_preview'> --}}
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
