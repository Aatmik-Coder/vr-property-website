<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $title = "Home";
        return view('front.home',compact('title'));
    }

    public function paymentinfo()
    {
        $title = "Payment Info";
        return view('front.paymentinfo',compact('title'));
    }
}
