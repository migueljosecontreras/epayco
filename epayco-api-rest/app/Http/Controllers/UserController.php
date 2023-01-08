<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function balance(Request $request)
    {
        $validator = validator($request->all(), [
            'document' => 'required|exists:users,document,deleted_at,NULL',
            'phone'    => 'required|exists:users,phone,deleted_at,NULL',
        ]);

        if($validator->fails())
        {
            return $this->validationErrorResponse($validator->errors());
        }

        $user = User::select(['balance'])->findUser()->first();

        if(!$user)
        {
            return $this->notFoundResponse(trans('general.msg.userNotFound'));
        }

        return $this->response($user);
    }
}
