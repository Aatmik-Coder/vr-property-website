@extends('admin.layouts.app')
@section('content')
<!-- Dashboard Counts Section-->
<link rel="stylesheet" href="{!! asset('assets/common/css/jquery.multiselect.css') !!}">
<style>
    form.form-horizontal {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
    }
    form.form-horizontal .form-group {
        flex: 0 0 50%;
    }
    form.form-horizontal .form-group:first-of-type {
        flex: 0 0 100%;
    }
    form.form-horizontal .form-group:last-of-type {
        flex: 0 0 100%;
    }
</style>
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <!-- Form Elements -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{!! route('developer.assign-properties.store') !!}" method="POST" class="form-horizontal">
                            @csrf
                            <div class="form-group row mb-3">
                                <label for="property_id">Properties name</label>
                                <div class="col-sm-6">
                                    <select name="property_id" id="property_id" class="form-control">
                                        <option value="">Select Property</option>
                                        @foreach ($properties as $property)
                                            <option value="{!! $property->id !!}">{!! $property->project_name !!}</option>
                                        @endforeach
                                    </select>
                                    @error('property_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="agency_id">Assign property to agency</label>
                                <div class="col-sm-6">
                                    <select name="agency_id[]" id="agency_id" multiple="multiple">
                                        @foreach ($agencies as $agency)
                                            <option value="{!! $agency->id !!}">{!! $agency->agency_name !!}</option>
                                            {{-- <input type="checkbox" name="agency_id" id="agency_id" class="role-checkbox" value="{!! $agency->id !!}"><label class="form-check-label" for="{!! $agency->id !!}">{!! $agency->agency_name !!}</label> --}}
                                        @endforeach
                                    </select>
                                    @error('agency_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="employee_id">Assign property to employee</label>
                                <div class="col-sm-6">
                                    <select name="employee_id[]" id="employee_id" multiple="multiple">
                                    @foreach ($employees as $employee)
                                    <option value="{!! $employee->id !!}">{!! $employee->person_name !!}</option>
                                        {{-- <input type="checkbox" name="employee_id" id="employee_id" class="role-checkbox" value="{!! $employee->id !!}"><label class="form-check-label" for="{!! $employee->id !!}">{!! $employee->person_name !!}</label> --}}
                                    @endforeach
                                    </select>
                                    @error('employee_id')
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
<script src="{!! asset('assets/common/js/jquery.multiselect.js') !!}"></script>
<script src="{{ asset('assets/admin/js/auth.js') }}"></script>
<script src="{{ asset('assets/admin/js/common.js') }}"></script>
@stop
@endsection