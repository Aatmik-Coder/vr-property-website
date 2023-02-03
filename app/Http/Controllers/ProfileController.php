<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Validation\Rule;
use File, Storage, Image;

class ProfileController extends Controller
{
    public function dashboard(Request $request)
    {
        return view('front.dashboard', [
            'title' => "Dashboard",
            'user' => $request->user(),
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('front.profile.edit', [
            'title' => "Your Account",
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    // public function update(ProfileUpdateRequest $request): RedirectResponse
    public function update(Request $request): RedirectResponse
    {
        $user = auth()->user();
        $request->validate([
            'first_name' => ['string', 'max:255'],
            'last_name' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'nick_name' => ['string', 'max:255'],
            'business_name' => ['string', 'max:255'],
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $quality = 70;
            $filename = uniqid().".".$ext;
            if(!$ext == 'png')
            {
                $destination = public_path(config('constants.TEMP_IMAGES')).$filename;
                File::ensureDirectoryExists(public_path(config('constants.TEMP_IMAGES')));
                $compressed_png_content = shell_exec("pngquant --quality=".$quality." - < ".escapeshellarg($image));
                if (!$compressed_png_content) {
                    die("Conversion to compressed PNG failed. Is pngquant 1.8+ installed on the server?");
                }
                Storage::put(config('constants.USER_PATH') .$filename, $compressed_png_content, 'public');
            } else {
                $resizedImage = Image::make($image)->encode($ext, $quality);
                Storage::put(config('constants.USER_PATH') .$filename, $resizedImage->__toString(), 'public');
            }
            $user->avatar = $filename;
        }

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->nick_name = $request->nick_name;
        $user->business_name = $request->business_name;
        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'Profile Updated Successfully');
    }
}
