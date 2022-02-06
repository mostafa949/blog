<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\auth\AuthLoginTraits;
use App\Traits\auth\DelegateRegisterTraits;
use App\Traits\auth\MarketerRegisterTraits;
use App\Traits\auth\MerchantRegisterTraits;
use App\Traits\auth\UserRegisterTraits;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use AuthLoginTraits, UserRegisterTraits;

    /**
     * @throws AuthenticationException
     */
    public function login(Request $request)
    {
        return $this->checkAuth($request);
    }

//    public
//    function check(Request $request)
//    {
////        $credentials = $request->only('email', 'password');
//        return $this->checkAuth($request);
//
//    }

    public function logout(Request $request)
    {
        Auth::guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}
