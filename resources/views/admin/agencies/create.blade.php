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
                        <form id="profileFrm" name="profileFrm" action="{!! route('admin.agencies.store') !!}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">Agency Name</label>
                                <div class="col-sm-9">
                                    <input id="agency_name" name="agency_name" type="text" class="form-control @error('agency_name') is-invalid @enderror" placeholder="enter agency name">
                                    @error('agency_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">Person Name</label>
                                <div class="col-sm-9">
                                    <input id="person_name" name="person_name" type="text" class="form-control @error('pname') is-invalid @enderror" placeholder="enter person name">
                                    @error('pname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">Person Email</label>
                                <div class="col-sm-9">
                                    <input id="person_email" name="person_email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="enter person email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">Person Phone Number</label>
                                <div class="col-sm-9">
                                    <input id="person_phone_number" name="person_phone_number" type="number" class="form-control @error('person_phone_number') is-invalid @enderror" placeholder="enter person phone number">
                                    @error('person_phone_number')
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
                                    @error('country_id')
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
                                    @error('state_id')
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
                                    @error('city_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">Address</label>
                                <div class="col-sm-9">
                                    <textarea type="text" name="address" id="address" placeholder="enter address" class="form-control @error('address') is-invalid @enderror"></textarea>
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
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
<script src="{{ asset('assets/admin/js/common.js') }}"></script>
@stop
@endsection
