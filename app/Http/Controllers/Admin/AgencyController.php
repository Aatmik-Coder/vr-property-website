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
use App\Models\State;
use App\Models\City;
use App\Models\Client;
use App\Models\Virtual_Meeting;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use Storage, File, Image;

class AgencyController extends Controller{
    public function dashboard(Request $request): View {
        $agency = auth($request->segment('1'))->user();
        return view('admin.agencies.dashboard',[
            'title' => "DashBoard",
            'agency' => $agency,
        ]);
    }

    public function properties_assigned(Request $request) {
        // dd(Auth('agency')->user()->id);
        $countries = Country::all();
        $get_property_id = Property_Assigned::where('agency_id',auth($request->segment('1'))->user()->id)->get();
        // dd($get_property_id);
        // dd($get_property_id);
        // $properties = Property::where('id',$get_property_id->property_id)->get();
        // if(!$properties) {
        //     return "EMPTY";
        // }
        // dd($properties);
        return view('admin.agencies.index',compact('countries','get_property_id'));
    }

    public function properties_assigned_ajax(Request $request) {
        // info($request->state);
        $columns = array('country_id','state_id','city_id','project_name','unit_type');

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = "created_at";
        $dir = "desc";

        if($request->input('order.0.column') != "" && $request->input('order.0.dir') != "") {
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');
        }

        $properties = Property_Assigned::where('agency_id',auth($request->segment('1'))->user()->id)->get();
        $total_data = $properties->count();
        $total_filter = $total_data;
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

        if($request->project_name) {
            $project_name = $request->project_name;
            $properties = $properties->filter(function($q) use ($project_name) {
                return stripos($q->properties->project_name, $project_name) !== false;
            });
            $total_filter = $properties->count();
        }

        if($request->unit_type) {
            $unit_type = $request->unit_type;
            $properties = $properties->filter(function($q) use ($unit_type) {
                return stripos($q->properties->unit_type, $unit_type) !== false;
            });
            $total_filter = $properties->count();
        }

        if($request->country) {
            $country_id = Country::find($request->country);
            $properties = $properties->filter(function($q) use ($country_id) {
                return stripos($q->properties->countries->name, $country_id->name) !== false;
            });
            $total_filter = $properties->count();
        }

        if($request->state) {
            $state_id = State::find($request->state);
            info($state_id);
            $properties = $properties->filter(function($q) use ($state_id) {
                return stripos($q->properties->states->name, $state_id->name) !== false;
            });
            $total_filter = $properties->count();
        }

        if($request->city) {
            $city_id = City::find($request->city);
            info($city_id);
            $properties = $properties->filter(function($q) use ($city_id) {
                return stripos($q->properties->cities->name, $city_id->name) !== false;
            });
            $total_filter = $properties->count();
        }

        $properties = $properties->sortByDesc(function($item) use ($order){
            return $item->properties->$order;
        })->slice($start,$limit);

        $data = array();
        if(!empty($properties)) {
            foreach($properties as $property) {
                $nestedData['country_id'] = $property->properties->countries->name;
                $nestedData['state_id'] = $property->properties->states->name;
                $nestedData['city_id'] = $property->properties->cities->name;
                $nestedData['project_name'] = $property->properties->project_name;
                $nestedData['unit_type'] = $property->properties->unit_type;

                $action = '<a href="/agency/properties-assigned/book-demo/'.$property->properties->id.'" class="btn action-btn" role="button" aria-pressed="true" title="Book Demo">';
                    $action .= '<i class="fa fa-handshake"></i>';
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

    public function book_demo($id) {
        $countries = Country::get();
        return view('admin.agencies.book-demo', compact('countries','id'));
    }

    public function save_demo(Request $request,$id) {
        $document = $request->file('upload_document');
        $document_name = time().'-'.$document.getClientOriginalName();
        move_uploaded_file($_FILES['document_name']['tmp_name'], public_path().'/assets/admin/client_documents/'.$document_name);

        $get_data = new Client;
        $get_data->property_id = $id;
        $get_data->type_of_admin = $request->segment('1');
        $get_data->admin_id = auth($request->segment('1'))->user()->id;
        $get_data->name = $request->input('name');
        $get_data->email = $request->input('email');
        $get_data->phone_number = $request->input('phone_number');
        $get_data->country_id = $request->input('country_id');
        $get_data->state_id = $request->input('state_id');
        $get_data->city_id = $request->input('city_id');
        $get_data->address = $request->input('address');
        $get_data->upload_document = $document_name;
        $get_data->save();
    }
}
