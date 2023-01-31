<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    var $module;
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->module = request()->segment(2);
    }
    public function index()
    {
        $title = "User";
        $user = User::all();
        
        return view('admin.'.$this->module.'.index', compact('title','user'));
    }

    public function ajax(Request $request)
    {
        $columns = array('first_name', 'last_name', 'email', 'nick_name', 'business_name', 'is_active', 'action');

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
        $total_data = $users->count();
        $total_filter = $total_data;
        if($request->input('search.value') != "")
        {
            $search = $request->input('search.value');
            $users = $users->where('first_name','LIKE',"%{$search}%")
                    ->orWhere('last_name', 'LIKE',"%{$search}%")
                    ->orWhere('email', 'LIKE',"%{$search}%")
                    ->orWhere('nick_name', 'LIKE',"%{$search}%")
                    ->orWhere('business_name', 'LIKE',"%{$search}%");
            $total_filter = $users->count();
        }
        $users = $users->offset($start)->limit($limit)->orderBy($order,$dir)->get();

        $data = array();
        if(!empty($users))
        {
            foreach ($users as $user)
            {
                $nestedData['first_name'] = $user->first_name;
                $nestedData['last_name'] = $user->last_name;
                $nestedData['email'] = $user->email;
                $nestedData['nick_name'] = $user->nick_name;
                $nestedData['business_name'] = $user->business_name;

                $status = '<a href="javascript:void(0);" onclick="changeStatus('.$user->id.')" class="btn action-btn" role="button" aria-pressed="true">';
                if($user->is_active == '1'){
                        $status .= '<i class="fa fa-check-circle green" aria-hidden="true"></i>';
                } else {
                    $status .= '<i class="fa fa-times-circle red" aria-hidden="true"></i>';
                }
                $status .= '</a>';
                $nestedData['is_active'] = $status;

                $action = '<a href="'.route("admin.user.view",$user->id).'" class="btn action-btn" role="button" aria-pressed="true" title="View">';
                    $action .= '<i class="fa fa-eye green" aria-hidden="true"></i>';
                $action .= '</a>';
                
                // $action .= '<a href="users/edit/'.$user->id.'" class="btn action-btn" role="button" aria-pressed="true" title="Edit">';
                //     $action .= '<i class="fa fa-pen green" aria-hidden="true"></i>';
                // $action .= '</a>';
                
                $action .= '<a href="javascript:void(0);" onclick="deleteData('.$user->id.')" class="btn action-btn" title="Delete" role="button" aria-pressed="true">';
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

    public function view($id)
    {
        $user = User::find($id);
        $title = "View User";
        return view('admin.user.view', compact('user','title'));
    }
}
