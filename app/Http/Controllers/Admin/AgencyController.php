<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Agency;
use App\Models\Country;
use Illuminate\Support\Facades\Validator;

class AgencyController extends Controller{
    public function index() {
        return view('admin.agencies.index');
    }

    public function create() {
        $countries = Country::get();
        return view('admin.agencies.create', compact('countries'));
    }

    public function store(Request $request) {
        $agency = Agency::create($request->all());
    }
}
