<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use DB;

class RoleController extends Controller{
    public function index() {
        return view('admin.roles.index');
    }

    public function ajax(Request $request)
    {
        $columns = array('id','name');

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = "created_at";
        $dir = "desc";
        if($request->input('order.0.column') != "" && $request->input('order.0.dir') != "")
        {
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');
        }

        $roles = new Role;
        $total_data = $roles->count();
        $total_filter = $total_data;
        if($request->input('search.value') != "")
        {
            $search = $request->input('search.value');
            $roles = $roles->where('name','LIKE',"%{$search}%")
                            ->orWhere('id','LIKE',"%{$search}%");
            $total_filter = $roles->count();
        }
        $roles = $roles->offset($start)->limit($limit)->orderBy($order,$dir)->get();

        $data = array();
        if(!empty($roles))
        {
            foreach ($roles as $role)
            {
                $nestedData['id'] = $role->id;
                $nestedData['name'] = $role->name;

                // $status = '<a href="javascript:void(0);" onclick="changeStatus('.$permission->id.')" class="btn action-btn" role="button" aria-pressed="true">';

                $action = '<a href="'.route("admin.roles.view",$role->id).'" class="btn action-btn" role="button" aria-pressed="true" title="View">';
                    $action .= '<i class="fa fa-eye green" aria-hidden="true"></i>';
                $action .= '</a>';

                $action .= '<a href="roles/'.$role->id.'/edit" class="btn action-btn" role="button" aria-pressed="true" title="Edit">';
                    $action .= '<i class="fa fa-pen green" aria-hidden="true"></i>';
                $action .= '</a>';

                $action .= '<a href="javascript:void(0);" onclick="deleteData(\''.route("admin.roles.destroy", $role->id).'\')" class="btn action-btn" title="Delete" role="button" aria-pressed="true">';
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
        $permissions = Permission::get();
        return view('admin.roles.create',compact('permissions'));
    }

    public function store(Request $request)
    {
        
        $role_permissions[] = $request->toArray();
        // dd($role_permissions[0]);
        $roles = new Role;
        $roles->name = $request->input('role');
        $roles->save();
        
        foreach(array_slice($role_permissions[0], '2') as $key=>$val){
            $role_permission = DB::insert('insert into role_has_permissions (permission_id, role_id) values (?, ?)', [$val, $roles->id]);
        }

        return redirect()->route('admin.roles.index');
    }

    public function edit($id) {
        $role = Role::find($id);
        $permissions = Permission::all();
        $role_permissions = Role::find($id)->permissions;
        return view('admin.roles.edit',compact('role','permissions','role_permissions'));
    }

    public function update(Request $request, $id) {
        $update_role_permission[] = $request->toArray();
        $updated_role = Role::where('id',$id)->update([
            'name'=>$request->name
        ]);
        $r_p = Role::find($id)->permissions;
        DB::delete('delete from role_has_permissions where role_id = ?',[$id]);
        foreach(array_slice($update_role_permission[0], '3') as $key=>$value) {
                DB::insert('insert into role_has_permissions (permission_id, role_id) values (?, ?)',[$value,$id]);
        }
        return redirect()->route('admin.roles.index');
    }

    public function view($id) {
        $role = Role::find($id);
        $role_permissions = Role::find($id)->permissions;
        return view('admin.roles.view', compact('role','role_permissions'));
    }

    public function destroy($id) {
        DB::delete('delete from role_has_permissions where role_id = ?',[$id]);
        Role::find($id)->delete($id);
        return response()->json([
            'success'=>'record deleted successfully!'
        ]);
    }
}