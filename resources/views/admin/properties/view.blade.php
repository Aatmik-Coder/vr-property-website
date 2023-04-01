@extends('admin.layouts.app')
@section('content')
<!-- Dashboard Counts Section-->
<section class="forms">
    <link rel="stylesheet" href="{!! asset('assets/admin/css/my.css') !!}">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-end mb-3">
                            <a href="{!! route(Request::segment(1).'.properties.index') !!}" class="btn btn-primary">Back</a>
                        </div>
                        <form action="" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">Country</label>
                                <div class="col-sm-5">
                                    <p class="form-control">{!! $country->name !!}</p>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">State/Province</label>
                                <div class="col-sm-5">
                                    <p class="form-control">{!! $state->name !!}</p>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">City</label>
                                <div class="col-sm-5">
                                    <p class="form-control">{!! $city->name !!}</p>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">Project Name</label>
                                <div class="col-sm-5">
                                    <p class="form-control">{!! $property->project_name !!}</p>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">Unit Type</label>
                                <div class="col-sm-5">
                                    <p class="form-control">{!! $property->unit_type !!}</p>
                                </div>
                            </div>
                            <div class="form-group row mb-3" id="type_of_building">
                                <label class="col-sm-3 form-control-label">Type of building</label>
                                <div class="col-sm-5">
                                    <p class="form-control">{!! $property->type_of_building !!}</p>
                                </div>
                            </div>
                            @if($property->unit_number)
                                <div class="form-group row mb-3" id="unit_number">
                                    <label class="col-sm-3 form-control-label">Unit Number</label>
                                    <div class="col-sm-5">
                                        <p class="form-control">{!! $property->unit_number !!}</p>
                                    </div>
                                </div>
                            @endif
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">Size</label>
                                <div class="col-sm-5">
                                    <p class="form-control">{!! $property->size !!}</p>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">Price</label>
                                <div class="col-sm-5">
                                    <p class="form-control">{!! $property->price !!}</p>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">Description</label>
                                <div class="col-sm-5">
                                    <p class="form-control">{!! $property->description !!}</p>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">Image</label>
                                <div class="col-sm-9">
                                    <div class="image_gallery">
                                        @foreach ($properties_image as $image)
                                            <div class="test">
                                                <img src="/assets/admin/property_image/{!! $image->image_name !!}" alt="property image">
                                            </div>                                            
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="line"> </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@section('js')
{{-- <script src="{{ asset('assets/admin/js/property.js') }}"></script> --}}
<script src="{{ asset('assets/admin/js/common.js') }}"></script>
@stop
@endsection
