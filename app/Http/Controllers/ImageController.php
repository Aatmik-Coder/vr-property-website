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
            'image' => 'required|image',
            'title' => 'required|max:255',
            'description' => 'required',
            'location' => 'required|max:255',
            'tags' => 'required',
            'status' => NULL,
            'is_paid' => 0,
            'is_active' => 0,
        ]);
        dd($request->all());
        $imageData = [
            'user_id' => auth('web')->user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'tags' => $request->tags,
        ];
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $quality = 70;
            $fileName = uniqid() . "." . $ext;
            if($ext == "png") {
                $destination = public_path(config('constants.TEMP_IMAGES')).$fileName;
                File::ensureDirectoryExists(public_path(config('constants.TEMP_IMAGES')));
                $compressed_png_content = shell_exec("pngquant --quality=".$quality." - < ".escapeshellarg($image));
                if (!$compressed_png_content) {
                    die("Conversion to compressed PNG failed. Is pngquant 1.8+ installed on the server?");
                }
                Storage::put(config('constants.IMAGE_PATH') .$fileName, $compressed_png_content, 'public');
            } else {
                $resizedImage = Image::make($image)->encode($ext, $quality);
                Storage::put(config('constants.IMAGE_PATH') .$fileName, $resizedImage->__toString(), 'public');
            }
            $imageData['file_name'] = $fileName;
            $imageData['width'] = Image::make($media)->width();
            $imageData['height'] = Image::make($media)->height();
            $imageData['size'] = Storage::size(config('constants.MEDIA_PATH').$fileName);
        }
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
