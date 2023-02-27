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

class AgencyController extends Controller{
    public function dashboard(Request $request): View {
        $agency = auth('agency')->user();
        return view('admin.agencies.dashboard',[
            'title' => "DashBoard",
            'agency' => $agency,
        ]);
    }

    // public function index() {
    //     return view('admin.agencies.index');
    // }

    public function create() {
        $countries = Country::get();
        return view('admin.agencies.create', compact('countries'));
    }

    public function store(Request $request) {
        $agency = Agency::create($request->all());
    }
}
