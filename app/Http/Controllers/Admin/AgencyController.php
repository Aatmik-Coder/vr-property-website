<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Developer;
use App\Models\Property;
use App\Models\Agency;
use App\Models\Employee;
use App\Models\Property_Assigned;
use App\Models\Country;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use Storage, File, Image;

class AgencyController extends Controller{
    public function dashboard(Request $request): View {
        $agency = auth('agency')->user();
        return view('admin.agencies.dashboard',[
            'title' => "DashBoard",
            'agency' => $agency,
        ]);
    }

    public function properties_assigned() {
        // dd(Auth('agency')->user()->id);
        $get_property_id = Property_Assigned::where('agency_id',Auth('agency')->user()->id)->first();
        // dd($get_property_id);
        $properties = Property::where('id',$get_property_id->property_id)->get();
        if(!$properties) {
            return "EMPTY";
        }
        // dd($properties);
        return view('admin.agencies.index');
    }

    public function properties_assigned_ajax(Request $request) {
        $columns = array('country_id','state_id','city_id','project_name','unit_type');

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = "created_at";
        $dir = "desc";

        if($request->input('order.0.column') != "" && $request->input('order.0.dir') != "") {
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');
        }

        $properties = Property_Assigned::where('agency_id',auth('agency')->user()->id)->get();
        // $properties = Property::where('id',$properties_122->property_id)->get();
        // dd($properties_122);
        $total_data = $properties->count();
        $total_filter = $total_data;
        // info($properties);
        if($request->input('search.value') != ""){
            $search = $request->input('search.value');
            $properties = $properties->filter(function ($q) use ($search){
                return stripos($q->properties->project_name, $search) !== false 
                || stripos($q->properties->unit_type, $search) !== false
                || stripos($q->properties->countries->name, $search) !== false
                || stripos($q->properties->states->name, $search) !== false
                || stripos($q->properties->cities->name, $search) !== false;
            });
            $total_filter = $properties->count();
        }

        $data = array();
        if(!empty($properties)) {
            foreach($properties as $property) {
                $nestedData['country_id'] = $property->properties->countries->name;
                $nestedData['state_id'] = $property->properties->states->name;
                $nestedData['city_id'] = $property->properties->cities->name;
                $nestedData['project_name'] = $property->properties->project_name;
                $nestedData['unit_type'] = $property->properties->unit_type;

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
    // public function index() {
    //     return view('admin.agencies.index');
    // }

    public function create() {
        $countries = Country::get();
        return view('admin.agencies.create', compact('countries'));
    }

    public function store(Request $request) {
        $agency = Agency::create($request->all());
    }
}
