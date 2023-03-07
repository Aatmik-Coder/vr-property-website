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
use App\Models\Property_Agency;
use App\Models\Property_Employee;
use App\Models\Country;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use Storage, File, Image;

class DeveloperController extends Controller{
    public function dashboard(Request $request): View
    {
        $developer = auth('developer')->user();
        return view('admin.developers.dashboard', [
            'title' => "Dashboard",
            'developer' => $developer,
        ]);
    }

    public function index() {
        return view('admin.developers.index');
    }

    public function create() {
        $countries = Country::get();
        return view('admin.developers.create',compact('countries'));
    }

    public function store(Request $request) {
        $developer = Developer::create($request->all());
        $request->session()->put('developer_id', $developer->id);
    }

    public function assigned_properties_agency_index() {
        return view('admin.developers.assign_properties.agency_index');
    }

    public function assigned_properties_employee_index() {
        return view('admin.developers.assign_properties.employee_index');
    }

    public function ajax(Request $request)
    {
        $show_detail = $request->columns[1]['name'];
        if($show_detail === 'agency_name') {
            $columns = array('property_id','agency_id');
            $get_name_to_find = 'agencies';
        } else if($show_detail === 'person_name') {
            $columns = array('property_id','employee_id');
            $get_name_to_find = 'employees';
        }
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = "created_at";
        $dir = "desc";
        if($request->input('order.0.column') != "" && $request->input('order.0.dir') != "")
        {
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');
        }
        if($show_detail === 'agency_name') {
            $assign_properties = new Property_Agency;
        }
        else if($show_detail === 'person_name'){
            $assign_properties = new Property_Employee;
        }
        $total_data = $assign_properties->count();
        $total_filter = $total_data;
        if($request->input('search.value') != "")
        {
            $search = $request->input('search.value');
            if($show_detail == 'agency_name') {
                $assign_properties = $assign_properties->orWhereHas('properties',function($q) use ($search){
                    $q->where('project_name','LIKE',"%{$search}%");
                })->orWhereHas('agencies',function($q) use ($search){
                    $q->where('agency_name','LIKE',"%{$search}%");
                });    
            }
            if($show_detail == 'person_name') {
                $assign_properties = $assign_properties->orWhereHas('properties',function($q) use ($search){
                    $q->where('project_name','LIKE',"%{$search}%");
                })->orWhereHas('employees',function($q) use ($search) {
                    $q->where('person_name','LIKE',"%{$search}%");
                });
            }
            $total_filter = $assign_properties->count();
        }
        $assign_properties = $assign_properties->offset($start)->limit($limit)->orderBy($order,$dir)->get();

        $data = array();
        if(!empty($assign_properties))
        {
            foreach ($assign_properties as $property_assign)
            {
                // dd($property_agency->properties);
                // if($property_agency->property_id){
                    $nestedData['project_name'] = $property_assign->properties->project_name;
                    $nestedData[$show_detail] = $property_assign->$get_name_to_find->$show_detail;
                    // if(isset($property_assign->employees->person_name)){
                    //     $nestedData['person_name'] = $property_assign->employees->person_name;
                    // } else {
                    //     $nestedData['person_name'] = NULL;
                    // }
                    // info($property_assign->employees->person_name);
                // }

                // $status = '<a href="javascript:void(0);" onclick="changeStatus('.$permission->id.')" class="btn action-btn" role="button" aria-pressed="true">';

                // $action = '<a href="'.route("admin.roles.view",$role->id).'" class="btn action-btn" role="button" aria-pressed="true" title="View">';
                //     $action .= '<i class="fa fa-eye green" aria-hidden="true"></i>';
                // $action .= '</a>';

                // $action .= '<a href="roles/'.$role->id.'/edit" class="btn action-btn" role="button" aria-pressed="true" title="Edit">';
                //     $action .= '<i class="fa fa-pen green" aria-hidden="true"></i>';
                // $action .= '</a>';

                // $action .= '<a href="javascript:void(0);" onclick="deleteData(\''.route("admin.roles.destroy", $role->id).'\')" class="btn action-btn" title="Delete" role="button" aria-pressed="true">';
                //     $action .= '<i class="fa fa-trash red" aria-hidden="true"></i>';
                // $action .= '</a>';

                // $nestedData['action'] = $action;

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

    public function assign_properties_create(){
        $developer = auth('developer')->user();
        $properties = Property::where(['type_of_login'=>"developer","login_id"=>$developer->id])->get();
        $agencies = Agency::all();
        $employees = Employee::all();
        return view('admin.developers.assign_properties.create', compact('properties','agencies','employees'));
    }
    public function assigned_properties_store(Request $request) {
        if($request->input('agency_id')) {
            $agencies = $request->input('agency_id');
            foreach($agencies as $agency) {
                $property_agency = new Property_Agency;
                $property_agency->property_id = $request->input('property_id');
                $property_agency->agency_id = $agency;
                $property_agency->save();
            }
            // return redirect()->route('developer.assign-properties.agency.index');
        }

        if($request->input('employee_id')) {
            $employees = $request->input('employee_id');
            foreach($employees as $employee) {
                $property_employee = new Property_Employee;
                $property_employee->property_id = $request->input('property_id');
                $property_employee->employee_id = $employee;
                $property_employee->save();
            }
        }
        return redirect()->route('developer.dashboard');
    }
}