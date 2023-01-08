<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Traits\Common\RequestServiceTrait;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use RequestServiceTrait;

    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function balance(Request $request){
        return call_user_func_array([$this, 'requestResponse'], array_values($this->userService->balance($request->only(['document', 'phone']))));
    }
}
