<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use App\Traits\Common\RequestServiceTrait;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use RequestServiceTrait;

    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request){
        return call_user_func_array([$this, 'requestResponse'], array_values($this->authService->login($request->only(['email', 'password']))));
    }

    public function register(Request $request){
        return call_user_func_array([$this, 'requestResponse'], array_values($this->authService->register($request->only(['name', 'email', 'password', 'phone', 'document']))));
    }
}
