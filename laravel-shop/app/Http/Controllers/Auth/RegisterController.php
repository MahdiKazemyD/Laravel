<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\Auth\RegisterService;
use Illuminate\Routing\Controller;

class RegisterController extends Controller
{
    protected object $RegisterService;

    public function __construct(RegisterService $RegisterService)
    {
        $this->RegisterService = $RegisterService;
    }

    public function register(RegisterRequest $request)
    {
        $data = $this->RegisterService->register($request);
        return new UserResource($data) ;
    }
}
