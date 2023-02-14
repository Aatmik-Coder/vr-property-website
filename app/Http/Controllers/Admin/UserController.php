<?php
    
namespace App\Http\Controllers\Admin;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Developer;
use App\Models\Country;
use DB;
use Hash;
use Illuminate\Support\Arr;
    
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
        $avatar = $request->file('avatar');
        $avatar_name = time().'-'.$avatar->getClientOriginalName();
        move_uploaded_file($_FILES['avatar']['tmp_name'],public_path().'/assets/admin/avatar/'.$avatar_name);

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
            $role->employee_name = $request->input($role_name->name . "_name");
        }
        $role->person_name = $request->input('person_name');
        $role->person_email = $request->input('person_email');
        $role->person_mobile_number = $request->input('person_mobile_number');
        $role->country_id = $request->input('country_id');
        $role->state_id = $request->input('state_id');
        $role->city_id = $request->input('city_id');
        $role->address = $request->input('address');
        $role->save();

        $user = new User;
        $user->role_id = $request->input('role_id');
        $user->avatar = $avatar_name;
        if($role_name->name == 'Developer'){
            $user->is_developer = '1';
        } else {
            $user->is_developer = '0';
        }

        if($role_name->name == 'Employee') {
            $user->is_employee = '1';
        } else {
            $user->is_employee = '0';
        }

        if($role_name->name == 'Agency') {
            $user->is_agency = '1';
        } else {
            $user->is_agency = '0';
        }
        $user->save();
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