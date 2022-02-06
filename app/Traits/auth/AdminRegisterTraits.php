<?php

namespace App\Traits\auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

trait AdminRegisterTraits
{

    public function registerUser()
    {
        return view('dashboard.user.register');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|max:50',
            'cpassword' => 'required|min:5|max:50|same:password',
        ]);

        $user = new User();
        $user->name = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $save = $user->save();

        if ($save) {
            Auth::guard('web')->login($user);
            return redirect()->back()->with('success', 'you are now registered successfully');
        } else {
            return redirect()->back()->with('fail', 'something went wrong, failed to register');
        }
    }
}
