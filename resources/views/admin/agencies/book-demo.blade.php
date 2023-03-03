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
                        <form action="" method="POST" class="form-horizonatal" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label" for="name">Name</label>
                                <div class="col-sm-6">
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="enter your name">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="email" class="col-sm-3 form-control-label">Email</label>
                                <div class="col-sm-6">
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="enter email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="phone_number" class="col-sm-3 form-control-label">Phone number</label>
                                <div class="col-sm-6">
                                    <input type="number" id="phone_number" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" placeholder="enter phone number">
                                    @error('phone_number') 
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label" for="country_id">Country</label>
                                <div class="col-sm-6">
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
                                <div class="col-sm-6">
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
                                <div class="col-sm-6">
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
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">Date</label>
                                <div class="col-sm-5">
                                    <input type="date" name="demo_date" id="demo_date" class="form-control @error('demo_date') is-invalid @enderror">
                                    @error('demo_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">Time</label>
                                <div class="col-sm-5">
                                    <input type="time" name="demo_time" id="demo_time" class="form-control @error('demo_time') is-invalid @enderror">
                                    @error('demo_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="" class="col-sm-3 form-control-label">TimeZone</label>
                                <div class="col-sm-5">
                                    <select name="timezone" id="" class="form-control">
                                        @foreach (timezone_identifiers_list() as $timezone)
                                            <option value="{!! $timezone !!}">{!! $timezone !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">Upload Document (passport, national ID)</label>
                                <div class="col-sm-5">
                                    <input type="file" name="upload_document" id="upload_document" class="form-control @error('upload_document') is-invalid @enderror">
                                    @error('upload_document')
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
                                    <button type="button" class="btn btn-secondary" onclick="location.href='{{ URL('/agency/properties-assigned') }}';">Cancel</button>
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