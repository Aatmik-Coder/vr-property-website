<?php
    
namespace App\Http\Controllers\Admin;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Developer;
use App\Models\Agency;
use App\Models\Employee;
use App\Models\Country;
use DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Validator;
    
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // var $module;
    // public function __construct()
    // {
    //     $this->module = request()->segment(2);
    // }

    public function index(Request $request)
    {
        return view('admin.users.index');
    }
    
    public function ajax(Request $request)
    {
        $columns = array('id','role_id');

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = "created_at";
        $dir = "desc";
        if($request->input('order.0.column') != "" && $request->input('order.0.dir') != "")
        {
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');
        }

        $users = new User;
        // $roles = new Role;
        $total_data = $users->count();
        $total_filter = $total_data;
        if($request->input('search.value') != "")
        {
            $search = $request->input('search.value');
            $users = $users->where('id','LIKE',"%{$search}%")->orWhereHas('roles', function ($q) use ($search) {
                $q->where('name','like',"%{$search}%");
            })->orWhereHas('developers', function ($q) use ($search) {
                $q->where('person_name','LIKE',"%{$search}%")
                    ->orWhere('person_email','like',"%{$search}%")
                    ->orWhere('person_mobile_number','like',"%{$search}%");
            })->orWhereHas('agencies', function ($q) use ($search) {
                $q->where('person_name','LIKE',"%{$search}%")
                    ->orWhere('person_email','like',"%{$search}%")
                    ->orWhere('person_mobile_number','like',"%{$search}%");
            })->orWhereHas('employees', function ($q) use ($search) {
                $q->where('person_name','LIKE',"%{$search}%")
                    ->orWhere('person_email','like',"%{$search}%")
                    ->orWhere('person_mobile_number','like',"%{$search}%");
            });
            $total_filter = $users->count();
        }
        $users = $users->offset($start)->limit($limit)->orderBy($order,$dir)->get();

        $data = array();
        if(!empty($users))
        {
            foreach ($users as $user)
            {
                // dd($user->developers->person_name);
                $nestedData['id'] = $user->id;
                $nestedData['name'] = $user->roles->name;
                if($user->is_developer){
                    $nestedData['person_name']=$user->developers->person_name;
                    $nestedData['person_email']=$user->developers->person_email;
                    $nestedData['person_mobile_number']=$user->developers->person_mobile_number;
                } else if($user->is_agency) {
                    $nestedData['person_name']=$user->agencies->person_name;
                    $nestedData['person_email']=$user->agencies->person_email;
                    $nestedData['person_mobile_number']=$user->agencies->person_mobile_number;
                } else if($user->is_employee){
                    $nestedData['person_name']=$user->employees->person_name;
                    $nestedData['person_email']=$user->employees->person_email;
                    $nestedData['person_mobile_number']=$user->employees->person_mobile_number;
                }

                // $status = '<a href="javascript:void(0);" onclick="changeStatus('.$permission->id.')" class="btn action-btn" role="button" aria-pressed="true">';

                // '.route("admin.roles.view",$user->id).'
                // roles/'.$user->id.'/edit
                // onclick="deleteData('.$user->id.')"
                $action = '<a href="'.route("admin.users.view",$user->id).'" class="btn action-btn" role="button" aria-pressed="true" title="View">';
                    $action .= '<i class="fa fa-eye green" aria-hidden="true"></i>';
                $action .= '</a>';

                $action .= '<a href="" class="btn action-btn" role="button" aria-pressed="true" title="Edit">';
                    $action .= '<i class="fa fa-pen green" aria-hidden="true"></i>';
                $action .= '</a>';

                $action .= '<a href="javascript:void(0);"  class="btn action-btn" title="Delete" role="button" aria-pressed="true">';
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        $countries = Country::get();
        return view('admin.users.create', compact('roles','countries'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $password = Str::random(10);
        $hashed_password = Hash::make($password);

        // $avatar = $request->file('avatar');
        // $avatar_name = time().'-'.$avatar->getClientOriginalName();
        // move_uploaded_file($_FILES['avatar']['tmp_name'],public_path().'/assets/admin/avatar/'.$avatar_name);
        $validate = $request->validate([
            'person_name'=>'required',
            'person_email'=>'required|email',
            'person_mobile_number'=>'required|numeric',
            'country_id'=>'required|numeric',
            'address'=>'required',
        ]);
        
        
        try{
            $role_name = Role::where('id',$request->role_id)->first();
            if($role_name->name == 'Developer') {
                $role = new Developer();
                $role->developer_name = $request->input($role_name->name . "_name");
            }
            if($role_name->name == 'Agency') {
                $role = new Agency();
                $role->agency_name = $request->input($role_name->name . "_name");
            }
            if($role_name->name == 'Employee') {
                $role = new Employee();
                // $role->employee_name = $request->input($role_name->name . "_name");
            }
            $role->person_name = $request->input('person_name');
            $role->person_email = $request->input('person_email');
            $role->person_password = $hashed_password;
            $role->person_mobile_number = $request->input('person_mobile_number');
            $role->country_id = $request->input('country_id');
            $role->state_id = $request->input('state_id');
            $role->city_id = $request->input('city_id');
            $role->address = $request->input('address');
            $role->save();

            $user = new User;
            $user->role_id = $request->input('role_id');
            $user->gender = $request->input('gender');
            if($role_name->name == 'Developer'){
                $user->is_developer = '1';
                $user->developer_id = $role->id;
            } else {
                $user->is_developer = '0';
                $user->developer_id = NULL;
            }

            if($role_name->name == 'Employee') {
                $user->is_employee = '1';
                $user->employee_id = $role->id;
            } else {
                $user->is_employee = '0';
                $user->employee_id = NULL;
            }
            
            if($role_name->name == 'Agency') {
                $user->is_agency = '1';
                $user->agency_id = $role->id;
            } else {
                $user->is_agency = '0';
                $user->agency_id = NULL;
            }
            $user->save();

            Mail::to($request->person_email)->send(new TestMail($request,$password));

            return redirect()->route('admin.users.index');
        } catch(\Exception $exception) {
            dd($exception);
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
    }
}