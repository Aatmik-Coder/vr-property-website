<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\ImageTag;
use App\Models\ImagePayment;

class ImageController extends Controller
{
    public function index(Request $request)
    {
        $images = Image::orderByDesc('id')->get();
        return view('front.image.list', [
            'title' => "Manage Your Gallery",
            'user' => $request->user(),
            'images' => $images,
        ]);
    }

    public function add(Request $request)
    {
        $image = new Image;
        return view('front.image.add', [
            'title' => "Upload an Image",
            'user' => $request->user(),
            'image' => $image,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required',
            'title' => 'required|max:255',
            'description' => 'required',
            'location' => 'required|max:255',
            'tags' => 'required',
        ]);
    }

    public function edit($id)
    {
        $image = Image::where(['id'=>$id, 'user_id' => $request->user()->id])->first();
        return view('front.image.add', [
            'title' => "Update an Image",
            'user' => $request->user(),
            'image' => $image,
        ]);
    }

    public function update(Request $request)
    {

    }

    public function delete(Request $request)
    {

    }
}
