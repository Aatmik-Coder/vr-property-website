<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Properties_image;
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
    public function index(Request $request)
    {
        // $title = "Properties";
        // $properties = Property::where('login_id',auth($request->segment(1))->user()->id)->get();
        return view('admin.properties.index');
        // ,compact('properties'));
    }

    public function ajax(Request $request)
    {
        $columns = array('project_name','unit_type','size','price');

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = "created_at";
        $dir = "desc";
        if($request->input('order.0.column') != "" && $request->input('order.0.dir') != "")
        {
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');
        }

        $properties = new Property;
        $total_data = $properties->count();
        $total_filter = $total_data;
        if($request->input('search.value') != "")
        {
            $search = $request->input('search.value');
            $properties = $properties->where('project_name','LIKE',"%{$search}%")
                            ->orWhere('unit_type','LIKE',"%{$search}%")
                            ->orWhere('size','LIKE',"%{$search}")
                            ->orWhere('price','LIKE',"%{$search}");
            $total_filter = $properties->count();
        }
        if($request->segment(1) != 'admin') {
            $properties = $properties->where('login_id',auth($request->segment(1))->user()->id)->offset($start)->limit($limit)->orderBy($order,$dir)->get();
        } else {
            $properties = $properties->offset($start)->limit($limit)->orderBy($order,$dir)->get();
        }

        $data = array();
        if(!empty($properties))
        {
            foreach ($properties as $property)
            {
                $nestedData['project_name'] = $property->project_name;
                $nestedData['unit_type'] = $property->unit_type;
                $nestedData['size'] = $property->size;
                $nestedData['price'] = $property->price;

                // $status = '<a href="javascript:void(0);" onclick="changeStatus('.$permission->id.')" class="btn action-btn" role="button" aria-pressed="true">';

                $action = '<a href="'.route($request->segment(1).".properties.view",$property->id).'" class="btn action-btn" role="button" aria-pressed="true" title="View">';
                    $action .= '<i class="fa fa-eye green" aria-hidden="true"></i>';
                $action .= '</a>';

                $action .= '<a href="properties/'.$property->id.'/edit" class="btn action-btn" role="button" aria-pressed="true" title="Edit">';
                    $action .= '<i class="fa fa-pen green" aria-hidden="true"></i>';
                $action .= '</a>';

                $action .= '<a href="javascript:void(0);" onclick="deleteData(\''.route($request->segment(1).".properties.destroy", $property->id).'\')" class="btn action-btn" title="Delete" role="button" aria-pressed="true">';
                    $action .= '<i class="fa fa-trash red" aria-hidden="true"></i>';
                $action .= '</a>';

                $nestedData['action'] = $action;

                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($total_data),
            "recordsFiltered" => intval($total_filter),
            "data"            => $data
        );
        echo json_encode($json_data);
    }

    public function create() {
        // $developer = Developer::get();
        $countries = Country::get();
        return view('admin.properties.create',compact('countries'));
    }

    public function store(Request $request) {
        $property = new Property;

        $property->type_of_login = $request->segment(1);
        $property->login_id = auth($request->segment(1))->user()->id;
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
        $property->save();
        
        $images = $request->file('image_name');
        foreach($request->file('image_name') as $image) {
            $new_name = time().'-'.$image->getClientOriginalName();
            move_uploaded_file($image->getPathName(),public_path().'/assets/admin/property_image/'.$new_name);            
            $add_image = new Properties_image;
            $add_image->property_id = $property->id;
            $add_image->image_name = $new_name;
            $add_image->save();
        }

        return redirect()->route('developer.properties.index');
    }

    public function view($id) {
        $property = Property::find($id);
        $country = Country::where('id',$property->country_id)->first();
        $state = State::where('id',$property->state_id)->first();
        $city = City::where('id',$property->city_id)->first();
        $properties_image = Properties_image::where('property_id',$property->id)->get();
        return view('admin.properties.view', compact('property','country','state','city','properties_image'));
    }

    public function edit($id) {
        $property = Property::find(1);
        $countries = Country::get();
        $states = State::where('country_id',$property->country_id)->get();
        $cities = City::where('state_id',$property->state_id)->get();
        $properties_image = Properties_image::where('property_id',$property->id)->get();
        // dd($properties_image);
        return view('admin.properties.edit',compact('property','countries','states','cities','properties_image'));
    }

    public function delete_files(Request $request) {
        $data['files'] = Property::where('id',$request->id)->first();
        $data['files']->image_name = null;
        $data['files']->save();

        $path = public_path().'/assets/admin/property_image/'.$request->file_name;
        unlink($path);
    }

    public function update(Request $request, $id){
        if($request->file('image_name')){
            $image = $request->file('image_name');
            $image_name = time().'-'.$image->getClientOriginalName();
            move_uploaded_file($_FILES["image_name"]["tmp_name"], public_path().'/assets/admin/property_image/'.$image_name);
        }else{
            $image_name = Property::find($id)->image_name;
        }

        if($request->unit_type != 'Residential' && ($request->type_of_building != 'flat' || $request->type_of_building != 'House/Villa' )) {
            $unit_number = null;
        } else{
            $unit_number = $request->unit_number;
        }
        $update_property = Property::where('id',$id)->update([
            'country_id'=>$request->country_id,
            'state_id'=>$request->state_id,
            'city_id'=>$request->city_id,
            'project_name'=>$request->project_name,
            'unit_type'=>$request->unit_type,
            'type_of_building'=>$request->type_of_building,
            'unit_number'=>$unit_number,
            'size'=>$request->size,
            'price'=>$request->price,
            'description'=>$request->description,
            'image_name'=>$image_name
        ]);
        return redirect()->route('developer.properties.index'); 
    }
}