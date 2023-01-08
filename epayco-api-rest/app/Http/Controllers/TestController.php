<?php

namespace App\Http\Controllers;

use App\Helpers\Common\Str;
use Symfony\Component\HttpFoundation\Response;
use App\Services\EmailService;
use App\Models\Token;
use App\Models\User;
use App\Mail\SSOStatusUnknownEmail;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function __construct()
    {
        //
    }

    public function test(){
        return response()->json(['msg' => 'Success','data' => Str::onlyText('Successfully test')], Response::HTTP_OK);
    }
}
