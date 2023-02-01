<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
   
    public function update(Request $request)
    {
        
        $user = auth()->user();
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|different:current_password|min:8',
            'password_confirmation' => 'required|same:password'
        ]);
       
        // // Match The Old Password current_password
        if(!Hash::check($request->current_password, $user->password)){
            return redirect()->back()->withErrors([
                'current_password' => 'Current Password does not match!',
            ]);
        }
        //Update password
        $user->password = Hash::make($request->password);
        $user->save();
        return back()->with(["message" => "Password Updated Successfully", 'alert-class' => 'success']);

        
    }
}
