@extends('admin.layouts.app')
@section('content')
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row mb-3">
                            <div class="col-sm-4">
                                <label class="col-sm-3 form-control-label" for="country_id">Country</label>
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
                            <div class="col-sm-4">
                                <label class="col-sm-3 form-control-label">State</label>
                                <select name="state_id" id="state_id" class="form-control @error('state') is-invalid @enderror">
                                </select>
                                @error('state_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-sm-4">
                                <label class="col-sm-3 form-control-label">City</label>
                                <select name="city_id" id="city_id" class="form-control @error('city') is-invalid @enderror">
                                </select>
                                @error('city_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label class="col-sm-3 form-control-label">Project name</label>
                                <select name="project_name" id="project_name" class="form-control @error('project_name') is-invalid @enderror">
                                    <option value="">Select project name</option>
                                    @foreach ($get_property_id as $property)
                                        <option>{!! $property->properties->project_name !!}</option>
                                    @endforeach
                                </select>
                                @error('project_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label class="col-sm-3 form-control-label">Unit Type</label>
                                <select name="unit_type" id="unit_type" class="form-control @error('unit_type') is-invalid @enderror">
                                    <option value="">Select unit type</option>
                                    @foreach ($get_property_id as $property)
                                        <option>{!! $property->properties->unit_type !!}</option>
                                    @endforeach
                                </select>
                                @error('state_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            
                        </div>
                       <table class="table text-center" id="data-table">
                            <thead>
                                <th>Country</th>
                                <th>State</th>
                                <th>City</th>
                                <th>Project Name</th>
                                <th>Unit type</th>
                                <th>Action</th>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Country</th>
                                    <th>State</th>
                                    <th>City</th>
                                    <th>Project Name</th>
                                    <th>Unit type</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@section('js')
<script src="{{ asset('assets/admin/js/employee.js') }}"></script>
<script src="{{ asset('assets/admin/js/common.js') }}"></script>
@stop
@endsection