<?php

namespace App\Traits\auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;

trait AuthLoginTraits
{
    protected function validateAndRoute(string $table)
    {
        request()->validate([
            'email' => 'required|exists:' . $table,
            'password' => 'required|min:8'
        ], [
            'email.exists' => 'The selected email not found.'
        ]);

        return redirect()->intended('/');
    }

    /**
     * @throws AuthenticationException
     */

    protected function checkAuth($request)
    {

        $credentials = $request->only('email', 'password');

        if (Auth::guard('web')->attempt($credentials)) {
            return $this->validateAndRoute('users');

        } else {
            Auth::guard('admin')->attempt($credentials);
            return $this->validateAndRoute('admins');
        }
    }
}
