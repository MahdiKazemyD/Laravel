<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginService
{
    public function login($request)
    {
        $token = Auth::attempt($request->only('email','password'));
        $user  = User::where('email',$request->email);
        $user->update(['api_token' => $token]);

        if (!$token) {
            return response([
                'massage' => 'email or password is false',
                'status'  => 'error',
            ], 401);
        }
        return Auth::user() ;
    }
}
