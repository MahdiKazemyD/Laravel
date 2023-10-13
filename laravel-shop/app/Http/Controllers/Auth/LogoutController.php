<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class LogoutController extends Controller
{
    public function logout()
    {
        Auth::logout();
        return response([
            'status'  => 'success',
            'message' => 'Successfully logged out',
        ]);
    }
}
