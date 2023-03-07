<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\Models\Developer;
use App\Models\Property;
use App\Models\Agency;
use App\Models\Employee;
use App\Models\Property_Agency;
use App\Models\Property_Employee;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Client;
use App\Models\Virtual_Meeting;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestDemoMail;
use Storage, File, Image;

class EmployeeController extends Controller{
    public function dashboard(Request $request): View
    {
        $employee = auth('employee')->user();
        return view('admin.employees.dashboard', [
            'title' => "Dashboard",
            'employee' => $employee,
        ]);
    }

    public function properties_assigned(Request $request) {
        $countries = Country::all();
        $get_property_id = Property_Employee::where('employee_id',auth($request->segment('1'))->user()->id)->get();

        return view('admin.employees.index',compact('countries','get_property_id'));
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

        $properties = Property_Employee::where('employee_id',auth($request->segment('1'))->user()->id)->get();
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

                $action = '<a href="/employee/properties-assigned/book-demo/'.$property->properties->id.'" class="btn action-btn" role="button" aria-pressed="true" title="Book Demo">';
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

    // public function assign_agency_create(){
    //     $developer = auth('developer')->user();
    //     $properties = Property::where(['type_of_login'=>"developer","login_id"=>$developer->id])->get();
    //     $agencies = Agency::all();
    //     return view('admin.developers.assign_agency.create', compact('properties','agencies'));
    // }

    // public function assigned_agency_store(Request $request) {
    //     $store_assigned_agency = new Property_Agency;
    //     $store_assigned_agency->property_id = $request->input('property_id');
    //     $store_assigned_agency->agency_id = $request->input('agency_id');
    //     $store_assigned_agency->save();

    //     return redirect()->route('developer.assign-agency.index');
    // }

    public function create() {
        $countries = Country::get();
        return view('admin.employees.create', compact('countries'));
    }

    public function store(Request $request) {
        $employee = Employee::create($request->all());
    }

    public function book_demo($id) {
        $countries = Country::get();
        return view('admin.employees.book-demo', compact('countries','id'));
    }

    public function save_demo(Request $request,$id) {
        $document = $request->file('upload_document');
        $document_name = time().'-'.$document->getClientOriginalName();
        move_uploaded_file($_FILES["upload_document"]["tmp_name"], public_path().'/assets/admin/client_documents/'.$document_name);

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

        // $time_according_to_zone = $request->input('demo_time');
        // $zone = $request->input('timezone');
        $get_demo_details = new Virtual_Meeting;
        $get_demo_details->client_id = $get_data->id;
        $get_demo_details->actual_link = "https://3d.thevrmakers.com/dev_parisar_v2/#meeting-key=7NHHvZ8Vc5cYFGrR";
        $get_demo_details->demo_date = $request->input('demo_date');
        $get_demo_details->demo_time = $request->input('demo_time');
        $get_demo_details->expiry_time = $request->input('expiry_time');
        $get_demo_details->timezone = $request->input('timezone');
        $get_demo_details->save();

        Mail::to($request->email)->send(new TestDemoMail($request,$get_demo_details->id));

        return redirect()->route('employee.dashboard');
    }

    public function demo_url(Request $request, $id) {
        // dd($id);
        $get_client_info = Client::where(['type_of_admin'=>'employee','admin_id'=>auth($request->segment('1'))->user()->id])->first();
        $tempLink = $request->segment(1);
        $get_virtual_info = Virtual_Meeting::find($id);
        $a_l = $get_virtual_info->actual_link;
        // if(Carbon::parse($get_virtual_info->demo_time)->format('Y-m-d H:i:s') <= now($get_virtual_info->timezone) && Carbon::parse($get_virtual_info->expiry_time)->format('Y-m-d H:i:s') > now($get_virtual_info->timezone)){
            return view('admin.temp-page',compact('get_virtual_info'));
        // }
        // return view('admin.timer');
    }

    public function meeting_ended() {
        return view('admin.meeting-ended');
    }

    public function meeting_not_started() {
        return view('admin.meeting-not-started');
    }
}