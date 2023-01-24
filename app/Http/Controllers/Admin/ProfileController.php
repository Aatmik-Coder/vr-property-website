<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use App\Models\Admin;
use Storage, File, Image;

class ProfileController extends Controller
{
    /**
     * Display the admin's dashboard.
     */
    public function dashboard(Request $request): View
    {
        $admin = auth('admin')->user();
        return view('admin.dashboard', [
            'title' => "Dashboard",
            'admin' => $admin,
        ]);
    }

    /**
     * Display the admin's profile form.
     */
    public function edit(Request $request): View
    {
        $admin = auth('admin')->user();
        return view('admin.profile', [
            'title' => "My Profile",
            'admin' => $admin,
        ]);
    }

    /**
     * Update the admin's profile information.
     */
    public function update(Request $request)
    {
        $admin = auth('admin')->user();
        $request->validate([
            'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(Admin::class)->ignore($admin->id)],
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $admin->name = $request->name;
        $admin->email = $request->email;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $quality = 70;
            $fileName = uniqid() . "." . $ext;
            if($ext == "png") {
                $destination = public_path(config('constants.TEMP_IMAGES')).$fileName;
                File::ensureDirectoryExists(public_path(config('constants.TEMP_IMAGES')));
                // guarantee that quality won't be worse than that.
                $compressed_png_content = shell_exec("pngquant --quality=".$quality." - < ".escapeshellarg($image));
                if (!$compressed_png_content) {
                    die("Conversion to compressed PNG failed. Is pngquant 1.8+ installed on the server?");
                }
                Storage::put(config('constants.ADMIN_PATH') .$fileName, $compressed_png_content, 'public');
            } else {
                $resizedImage = Image::make($image)->encode($ext, $quality);
                Storage::put(config('constants.ADMIN_PATH') .$fileName, $resizedImage->__toString(), 'public');
            }
            $admin->avatar = $fileName;
        }
        $admin->save();

        return Redirect::route('admin.profile.edit')->with('status', 'Profile updated successfully!');
    }
}
