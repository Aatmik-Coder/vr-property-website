<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
// use App\Models\Developer;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Http\Request;


class PropertiesController extends Controller
{
    // var $module;
    // public function __construct()
    // {
    //     $this->module = request()->segment(2);
    // }
    public function index()
    {
        // $title = "Properties";
        return view('admin.properties.index');
    }

    public function create() {
        // $developer = Developer::get();
        $countries = Country::get();
        return view('admin.properties.create',compact('countries'));
    }

    public function store(Request $request) {
        $developer_id = $request->session()->get('developer_id');

        $image = $request->file('image_name');
        $image_name = time().'-'.$image->getClientOriginalName();
        move_uploaded_file($_FILES["image_name"]["tmp_name"],public_path().'/assets/admin/property_image/'.$image_name);
        $property = new Property;
        $property->developer_id = $developer_id;
        $property->country_id = $request->input('country_id');
        $property->state_id = $request->input('state_id');
        $property->city_id = $request->input('city_id');
        $property->project_name = $request->input('project_name');
        $property->unit_type = $request->input('unit_type');
        $property->type_of_building = $request->input('type_of_building');
        $property->unit_number = $request->input('unit_number');
        $property->size = $request->input('size');
        $property->price = $request->input('price');
        $property->description = $request->input('description');
        $property->image_name = $image_name;
        $property->save();
        
        return view('admin.properties.index');
    }
}