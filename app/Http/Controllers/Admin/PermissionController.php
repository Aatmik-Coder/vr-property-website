<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Support\Facades\Validator;
use DB;

class PermissionController extends Controller{
    public function index() {
        return view('admin.permissions.index');
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

        $permissions = new Permission;
        $total_data = $permissions->count();
        $total_filter = $total_data;
        if($request->input('search.value') != "")
        {
            $search = $request->input('search.value');
            $permissions = $permissions->where('name','LIKE',"%{$search}%")
                            ->orWhere('id','LIKE',"%{$search}%");
            $total_filter = $permissions->count();
        }
        $permissions = $permissions->offset($start)->limit($limit)->orderBy($order,$dir)->get();

        $data = array();
        if(!empty($permissions))
        {
            foreach ($permissions as $permission)
            {
                $nestedData['id'] = $permission->id;
                $nestedData['name'] = $permission->name;

                // $status = '<a href="javascript:void(0);" onclick="changeStatus('.$permission->id.')" class="btn action-btn" role="button" aria-pressed="true">';

                // $action = '<a href="'.route("admin.permissions.view",$permission->id).'" class="btn action-btn" role="button" aria-pressed="true" title="View">';
                //     $action .= '<i class="fa fa-eye green" aria-hidden="true"></i>';
                // $action .= '</a>';

                $action = '<a href="permissions/'.$permission->id.'/edit" class="btn action-btn" role="button" aria-pressed="true" title="Edit">';
                    $action .= '<i class="fa fa-pen green" aria-hidden="true"></i>';
                $action .= '</a>';

                $action .= '<a href="javascript:void(0);" onclick="deleteData(\''.route("admin.permissions.destroy",$permission->id).'\')" class="btn action-btn" title="Delete" role="button" aria-pressed="true">';
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
        return view('admin.permissions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);

        $new_permission = new Permission;
        $new_permission->name = $request->input('name');
        $new_permission->save();
       return redirect('/admin/permissions');

    }

    public function view($id) {
        $permission = Permission::find($id);
        return view('admin.permissions.view',compact('permission'));
    }

    public function edit($id) {
        $permission = Permission::find($id);
        return view('admin.permissions.edit', compact('permission'));
    }

    public function update(Request $request, $id) {
        $update_permission = Permission::where('id',$id)->update([
            'name'=>$request->name
        ]);
        return redirect('/admin/permissions');
    }

    public function destroy($id) {
        DB::delete('delete from role_has_permissions where permission_id = ?',[$id]);
        Permission::find($id)->delete($id);

        return response()->json([
            'success'=>'record deleted successfully!'
        ]);
    }
}