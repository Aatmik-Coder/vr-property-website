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
                        {{-- <style>
                            .rad{
                                margin-right: 5px;
                            }
                            .image_gallery{
                                display: flex;
                                flex-direction: row;
                                flex-wrap: wrap;
                                justify-content: space-between;
                                gap: 10px; 
                            }
                            .test {
                                position: relative;
                                flex: 0 0 calc(33.33% - 10px);
                            max-width: calc(33.33% - 10px);
                            }
                            .test img {
                                width: 100%;
                            }
                            span.del {
                                position: absolute;
                                top: 10px;
                                left: auto;
                                right: 10px;
                                width: 30px;
                                height: 30px;
                                line-height: 30px;
                                /* border-radius: 50%; */
                                /* background: #fe6aa9; */
                                text-align: center;
                                /* color: #ffffff; */
                                /* font-weight: bold; */
                                opacity: 0;
                            }
                            span.view {
                                position: absolute;
                                top: 10px;
                                left: 10px;
                                right: auto;
                                width: 30px;
                                height: 30px;
                                line-height: 30px;
                                text-align: center;
                                opacity: 0;
                            }
                            .test:hover .del {
                                opacity: 1;
                            }
                            .test:hover .view {
                                opacity: 1;
                            }
                        </style> --}}
                        <form action="{!! route(Request::segment(1).'.properties.update',$property->id) !!}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input name="csrfToken" value="{{ csrf_token() }}" type="hidden">
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">Country</label>
                                <div class="col-sm-5">
                                    <select name="country_id" id="country_id" class="form-control">
                                        <option value="">Select country</option>
                                        @foreach ($countries as $country)
                                            <option value="{!! $country->id !!}" @if($property->country_id == $country->id) selected @endif class="form-control">{!! $country->name !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">State/Province</label>
                                <div class="col-sm-5">
                                    <select name="state_id" id="state_id" class="form-control">
                                        @foreach ($states as $state)
                                            <option value="{!! $state->id !!}" @if($property->state_id == $state->id) selected @endif class="form-control">{!! $state->name !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">City</label>
                                <div class="col-sm-5">
                                    <select name="city_id" id="city_id" class="form-control">
                                        @foreach ($cities as $city)
                                            <option value="{!! $city->id !!}" @if($property->city_id == $city->id) selected @endif class="form-control">{!! $city->name !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">Project Name</label>
                                <div class="col-sm-5">
                                    <input type="text" name="project_name" class="form-control" placeholder="enter project name" value="{!! $property->project_name !!}">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">Unit Type</label>
                                <div class="col-sm-9">
                                    <input type="radio" class="form-check-input rad unit_type" name="unit_type" value="Residential" id="Residential" @if($property->unit_type == 'Residential') checked @endif>Residential
                                    <input type="radio" class="form-check-input rad unit_type" name="unit_type" value="Commercial" id="Commercial" @if($property->unit_type == 'Commercial') checked @endif>Commercial
                                    <input type="radio" class="form-check-input rad unit_type" name="unit_type" value="Other Property Type" id="Other Property Type" @if($property->unit_type == 'Other Property Type') checked @endif>Other Property Type
                                </div>
                            </div>
                            <div class="form-group row mb-3" id="type_of_building">
                                <label class="col-sm-3 form-control-label">Type of building</label>
                                @if($property->unit_type == 'Residential')
                                    <div class="col-sm-9">
                                        <input type="radio" class="form-check-input rad type_of_building" name="type_of_building" value="flat" @if($property->type_of_building == 'flat') checked @endif>flat
                                        <input type="radio" class="form-check-input rad type_of_building" name="type_of_building" value="House/Villa" @if($property->type_of_building == 'House/Villa') checked @endif>House/Villa
                                        <input type="radio" class="form-check-input rad type_of_building" name="type_of_building" value="plot" @if($property->type_of_building == 'plot') checked @endif>plot
                                    </div>
                                @endif
                                @if($property->unit_type == 'Commercial')
                                    <div class="col-sm-9">
                                        <input type="radio" class="form-check-input rad type_of_building" name="type_of_building" value="Office Space" @if($property->type_of_building == 'Office Space') checked @endif>Office Space
                                        <input type="radio" class="form-check-input rad type_of_building" name="type_of_building" value="Shop/Showroom" @if($property->type_of_building == 'Shop/Showroom') checked @endif>Shop/Showroom
                                        <input type="radio" class="form-check-input rad type_of_building" name="type_of_building" value="Commercial Land" @if($property->type_of_building == 'Commercial Land') checked @endif>Commercial Land
                                    </div>
                                @endif
                                @if($property->unit_type == 'Other Property Type')
                                    <div class="col-sm-9">
                                        <input type="radio" class="form-check-input rad type_of_building" name="type_of_building" value="Agricultural Land" @if($property->type_of_building == 'Agricultural Land') checked @endif>Agricultural Land
                                        <input type="radio" class="form-check-input rad type_of_building" name="type_of_building" value="Farm House" @if($property->type_of_building == 'Farm House') checked @endif>Farm House
                                    </div>
                                @endif
                            </div>
                            <div class="form-group row mb-3" id="unit_number">
                                <label class="col-sm-3 form-control-label">Unit Number</label>
                                <div class="col-sm-5">
                                    <input type="radio" class="form-check-input rad" name="unit_number" value="1 Bhk" @if($property->unit_number == '1 Bhk') checked @endif>1 Bhk
                                    <input type="radio" class="form-check-input rad" name="unit_number" value="2 Bhk" @if($property->unit_number == '2 Bhk') checked @endif>2 Bhk
                                    <input type="radio" class="form-check-input rad" name="unit_number" value="3 Bhk" @if($property->unit_number == '3 Bhk') checked @endif>3 Bhk
                                    <input type="radio" class="form-check-input rad" name="unit_number" value="4 Bhk" @if($property->unit_number == '4 Bhk') checked @endif>4 Bhk
                                    <input type="radio" class="form-check-input rad" name="unit_number" value="5 Bhk" @if($property->unit_number == '5 Bhk') checked @endif>5 Bhk
                                    <input type="radio" class="form-check-input rad" name="unit_number" value="5 Bhk+" @if($property->unit_number == '5 Bhk+') checked @endif>5 Bhk+
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">Size</label>
                                <div class="col-sm-5">
                                    <input type="text" name="size" class="form-control" value="{!! $property->size !!}">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">Price</label>
                                <div class="col-sm-5">
                                    <input type="number" name="price" class="form-control" value="{!! $property->price !!}">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">Description</label>
                                <div class="col-sm-5">
                                    <textarea type="text" name="description" class="form-control" placeholder="enter description">{!! $property->description !!}</textarea>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">Image</label>
                                <div class="col-sm-9">
                                    @if ($properties_image == null)
                                        <input type="file" name="image_name[]" class="form-control" multiple>
                                    @else
                                    <div class="image_gallery">
                                    @foreach ($properties_image as $image)
                                    <div class="test">
                                            <img src="/assets/admin/property_image/{!! $image->image_name !!}" width="auto" height="auto">
                                            <span class="view"><a href="{!! urldecode('/assets/admin/property_image/'.$image->image_name) !!}" target="_blank"><i class="fa-solid fa-2xl fa-eye" style="color: purple;"></i></a></span>
                                            <span class="del"><a href="" onclick="Delete('{!! $image->image_name !!}','{!! $image->id  !!}')"><i class="fa-solid fa-2xl fa-trash" style="color: red;"></i></a></span>
                                        </div>                                            
                                            @endforeach
                                        </div>
                                        {{-- <a href="{!! urldecode('/assets/admin/property_image/'.$property->image_name) !!}" target="_blank"><i class="fa-solid fa-2xl fa-eye" style="color: purple;"></i></a>
                                        <a href="" onclick="Delete('{!! $property->image_name !!}','{!! $property->id  !!}')"><i class="fa-solid fa-2xl fa-trash" style="color: red;"></i></a> --}}
                                    @endif
                                </div>
                            </div>
                            <div class="line"> </div>
                            <div class="form-group row">
                                <div class="col-sm-4 offset-sm-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="button" class="btn btn-secondary" onclick="location.href='{{ URL('/'.Request::segment(1).'/properties') }}';">Back</button>
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
