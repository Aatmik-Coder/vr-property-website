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

class AgencyController extends Controller{
    public function dashboard(Request $request): View {
        $agency = auth($request->segment('1'))->user();

        return view('admin.agencies.dashboard',[
            'title' => "DashBoard",
            'agency' => $agency,
        ]);
    }

    public function properties_assigned(Request $request) {
        $countries = Country::all();
        $get_property_id = Property_Agency::where('agency_id',auth($request->segment('1'))->user()->id)->get();

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

        $properties = Property_Agency::where('agency_id',auth($request->segment('1'))->user()->id)->get();
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
        $demo_time = Carbon::parse($request->input('demo_time'))->tz($request->input('timezone'));
        $expiry_time = Carbon::parse($request->input('expiry_time'))->tz($request->input('timezone'));


        $get_demo_details = new Virtual_Meeting;
        $get_demo_details->client_id = $get_data->id;
        $get_demo_details->actual_link = "https://3d.thevrmakers.com/lower_floor_model/#meeting-key=lJ4jRML8Xf4IJomz";
        $get_demo_details->demo_date = $request->input('demo_date');
        $get_demo_details->demo_time = $demo_time;
        $get_demo_details->expiry_time = $expiry_time;
        $get_demo_details->timezone = $request->input('timezone');
        $get_demo_details->save();

        Mail::to($request->email)->send(new TestDemoMail($get_demo_details->id));

        return redirect()->route('agency.dashboard');
    }

    public function demo_url(Request $request,$id) {
        $get_client_info = Client::where(['type_of_admin'=>'agency','admin_id'=>auth($request->segment('1'))->user()->id])->first();
        $tempLink = $request->segment(1);
        $get_virtual_info = Virtual_Meeting::find($id);
        // if(Carbon::parse($get_virtual_info->demo_time)->format('Y-m-d H:i:s') <= now($get_virtual_info->timezone) && Carbon::parse($get_virtual_info->expiry_time)->format('Y-m-d H:i:s') > now($get_virtual_info->timezone)){
        return view('admin.temp-page',compact('get_virtual_info'));
        // }
    }

    public function meeting_ended() {
        return view('admin.meeting-ended');
    }

    public function meeting_not_started() {
        return view('admin.meeting-not-started');
    }

    public function upcoming_meeting() {
        return view('admin.agencies.upcoming-meeting');
    }

    public function upcoming_meeting_ajax(Request $request) {
        $columns = array('name','email','phone_number','project_name','demo_date','demo_time');

        $fetch_s = Client::where('admin_id',auth($request->segment('1'))->user()->id)->get();
        info($fetch_s);

        // $limit = $request->input('length');
        // $start = $request->input('start');
        // $order = "created_at";
        // $dir = "desc";
        
        // if($request->input('order.0.column') != "" && $request->input('order.0.dir') != "") {
        //     $order = $columns[$request->input('order.0.column')];
        //     $dir = $request->input('order.0.dir');
        // }
    }
}
