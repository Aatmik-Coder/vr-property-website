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
                        <style>
                            .rad{
                                margin-right: 5px;
                            }
                        </style>
                        <form id="profileFrm" name="profileFrm" action="{!! route('admin.users.store') !!}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label" for="roles">Role</label>
                                <div class="col-sm-9">
                                    <select name="role_id" id="role_id" class="form-control">
                                        <option value="" selected>Select</option>
                                        @foreach ($roles as $role)
                                            <option value="{!! $role->id !!}">{!! $role->name !!}</option>
                                        @endforeach
                                    </select>
                                    {{-- <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ?? $admin->name }}"> --}}
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3" id="type_name">
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">Name</label>
                                <div class="col-sm-9">
                                    <input id="person_name" name="person_name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="enter name">
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
                                    <input id="person_email" name="person_email" type="text" class="form-control @error('email') is-invalid @enderror" placeholder="enter email">
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
                                    <input id="person_mobile_number" name="person_mobile_number" type="number" class="form-control @error('mobile') is-invalid @enderror" placeholder="enter mobile number" min="1">
                                    @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">Gender</label>
                                <div class="col-sm-9">
                                    <input id="gender" name="gender" type="radio" class="form-check-input rad gender @error('gender') is-invalid @enderror" value="Male">Male
                                    <input id="gender" name="gender" type="radio" class="form-check-input rad gender @error('gender') is-invalid @enderror" value="Female">Female
                                    @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">Country</label>
                                <div class="col-sm-9">
                                    <select name="country_id" id="country_id" class="form-control @error('country') is-invalid @enderror">
                                        <option value="">Select Country</option>
                                        @foreach ($countries as $country)
                                            <option value="{!! $country->id !!}">{!! $country->name !!}</option>
                                        @endforeach
                                    </select>
                                    @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">State</label>
                                <div class="col-sm-9">
                                    <select name="state_id" id="state_id" class="form-control @error('state') is-invalid @enderror">
                                    </select>
                                    @error('state')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">City</label>
                                <div class="col-sm-9">
                                    <select name="city_id" id="city_id" class="form-control @error('city') is-invalid @enderror">
                                    </select>
                                    @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">Address</label>
                                <div class="col-sm-9">
                                    <textarea type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" placeholder="enter address"></textarea>
                                    @error('address')
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
                                    <button type="button" class="btn btn-secondary" onclick="location.href='{{ URL('/'.Request::segment(1).'/users') }}';">Cancel</button>
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
<script src="{{ asset('assets/admin/js/common.js') }}"></script>
<script src="{{ asset('assets/admin/js/user.js') }}"></script>
@stop
@endsection
