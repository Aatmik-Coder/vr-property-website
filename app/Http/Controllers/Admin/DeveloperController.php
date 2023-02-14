<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Developer;
use App\Models\Country;
use Illuminate\Support\Facades\Validator;

class DeveloperController extends Controller{
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