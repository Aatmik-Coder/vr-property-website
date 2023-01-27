<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Validator;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }

    public function changePassword(Request $request)
    {
        return view('admin.auth.password', ['title' => 'Change Password','request' => $request]);
    }

    public function updatePassword(Request $request)
    
    {
        $input = $request->all();
        // dd($input);
        
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|different:current_password|min:8',
            'password_confirmation' => 'required|same:password'
        ]);
        

        // // Match The Old Password current_password
        if(!Hash::check($request->current_password, auth('admin')->user()->password)){
            return back()->with(['message'=>"Current Password does not match", 'alert-class' => 'error']);
        }
        //Update password
    Admin::where('id', auth('admin')->user()->id)->update([
        'password' => Hash::make($request->password),
    ]);

    return redirect()->back()->with(["message" => "Password changed successfully!", 'alert-class' => 'success']);

    }
    }