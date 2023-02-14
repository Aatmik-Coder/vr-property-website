@extends('admin.layouts.app')
@section('content')
<!-- Dashboard Counts Section-->
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <style>
                            .rad{
                                margin-right: 5px;
                            }
                        </style>
                        <form action="{!! route('admin.properties.store') !!}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">Country</label>
                                <div class="col-sm-5">
                                    <select name="country_id" id="country_id" class="form-control">
                                        <option value="">Select country</option>
                                        @foreach ($countries as $country)
                                            <option value="{!! $country->id !!}" class="form-control">{!! $country->name !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">State/Province</label>
                                <div class="col-sm-5">
                                    <select name="state_id" id="state_id" class="form-control">
 
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">City</label>
                                <div class="col-sm-5">
                                    <select name="city_id" id="city_id" class="form-control">

                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">Project Name</label>
                                <div class="col-sm-5">
                                    <input type="text" name="project_name" class="form-control" placeholder="enter project name">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">Unit Type</label>
                                <div class="col-sm-9">
                                    <input type="radio" class="form-check-input rad unit_type" name="unit_type" value="Residential" id="Residential">Residential
                                    <input type="radio" class="form-check-input rad unit_type" name="unit_type" value="Commercial" id="Commercial">Commercial
                                    <input type="radio" class="form-check-input rad unit_type" name="unit_type" value="Other Property Type" id="Other Property Type">Other Property Type
                                </div>
                            </div>
                            <div class="form-group row mb-3" id="type_of_building" hidden>
                                <label class="col-sm-3 form-control-label">Type of building</label>
                            </div>
                            <div class="form-group row mb-3" id="unit_number">
                                <label class="col-sm-3 form-control-label">Unit Number</label>
                                <div class="col-sm-5">
                                    <input type="radio" class="form-check-input rad" name="unit_number" value="1 Bhk">1 Bhk
                                    <input type="radio" class="form-check-input rad" name="unit_number" value="2 Bhk">2 Bhk
                                    <input type="radio" class="form-check-input rad" name="unit_number" value="3 Bhk">3 Bhk
                                    <input type="radio" class="form-check-input rad" name="unit_number" value="4 Bhk">4 Bhk
                                    <input type="radio" class="form-check-input rad" name="unit_number" value="5 Bhk">5 Bhk
                                    <input type="radio" class="form-check-input rad" name="unit_number" value="5 Bhk+">5 Bhk+
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">Size</label>
                                <div class="col-sm-5">
                                    <input type="text" name="size" class="form-control" placeholder="size in sqft">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">Price</label>
                                <div class="col-sm-5">
                                    <input type="number" name="price" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">Description</label>
                                <div class="col-sm-5">
                                    <textarea type="text" name="description" class="form-control" placeholder="enter description"></textarea>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">Image</label>
                                <div class="col-sm-5">
                                    <input type="file" name="image_name" class="form-control">
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
<script src="{{ asset('assets/admin/js/property.js') }}"></script>
<script src="{{ asset('assets/admin/js/common.js') }}"></script>
@stop
@endsection
