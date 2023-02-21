<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Developer;
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
}