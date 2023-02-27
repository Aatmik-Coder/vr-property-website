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
use App\Models\Country;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
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

    public function assigned_agency_index() {
        return view('admin.developers.assign_agency.index');
    }

    public function ajax(Request $request)
    {
        $columns = array('property_id','agency_id');

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = "created_at";
        $dir = "desc";
        if($request->input('order.0.column') != "" && $request->input('order.0.dir') != "")
        {
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');
        }

        $properties_agencies = new Property_Agency;
        $total_data = $properties_agencies->count();
        $total_filter = $total_data;
        if($request->input('search.value') != "")
        {
            $search = $request->input('search.value');
            $properties_agencies = $properties_agencies->orWhereHas('properties',function($q) use ($search){
                $q->where('project_name','LIKE',"%{$search}%");
            })->orWhereHas('agencies',function($q) use ($search){
                $q->where('agency_name','LIKE',"%{$search}%");
            });
            $total_filter = $properties_agencies->count();
        }
        $properties_agencies = $properties_agencies->offset($start)->limit($limit)->orderBy($order,$dir)->get();

        $data = array();
        if(!empty($properties_agencies))
        {
            foreach ($properties_agencies as $property_agency)
            {
                // dd($property_agency->properties);
                // if($property_agency->property_id){
                    $nestedData['project_name'] = $property_agency->properties->project_name;
                    $nestedData['agency_name'] = $property_agency->agencies->agency_name;
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

    public function assign_agency_create(){
        $developer = auth('developer')->user();
        $properties = Property::where(['type_of_login'=>"developer","login_id"=>$developer->id])->get();
        $agencies = Agency::all();
        return view('admin.developers.assign_agency.create', compact('properties','agencies'));
    }

    public function assigned_agency_store(Request $request) {
        $store_assigned_agency = new Property_Agency;
        $store_assigned_agency->property_id = $request->input('property_id');
        $store_assigned_agency->agency_id = $request->input('agency_id');
        $store_assigned_agency->save();

        return redirect()->route('developer.assign-agency.index');
    }
}