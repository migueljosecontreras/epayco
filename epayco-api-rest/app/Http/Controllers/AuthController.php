<?php

namespace App\Http\Controllers;

use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = validator($request->all(), [
            'email'    => 'required|email|max:100',
            'password' => 'required|max:15',
        ]);

        if($validator->fails())
        {
            return $this->validationErrorResponse($validator->errors());
        }

        $jwtToken = auth()->attempt([ 'email' => $request->email, 'password' => $request->password ]);

        $user = \Auth::user();

        if($jwtToken && $user)
        {
            if(!$user->active)
            {
                return $this->unauthorizedResponse(trans('general.msg.userNotActive'));
            }

            if(!$user->role)
            {
                return $this->unauthorizedResponse(trans('general.msg.userWithoutRole'));
            }

            if(is_null($user->deleted_at))
            {
                $token = new Token();

                $token->token   = $jwtToken;
                $token->user_id = $user->id;
                $token->type    = 'user';
                $token->from    = 'myself';
                $token->date    = date('Y-m-d H:i:s');

                if($token->secureSave())
                {
                    return $this->response([
                                               'token'   => $token->token,
                                               'name'    => $user->name,
                                               'email'   => $user->email,
                                               'balance' => $user->balance,
                                               'role'    => $user->role,
                                               'id'      => $user->id,

                                           ]);
                }
                else
                {
                    return $this->internalErrorResponse();
                }
            }
        }

        return $this->unauthorizedResponse();
    }

    public function register(Request $request)
    {
        $validator = validator($request->all(), User::rules());

        if($validator->fails())
        {
            return $this->validationErrorResponse($validator->errors());
        }

        $user = new User($request->only(User::getFillables()));

        $user->role    = 'client';
        $user->active  = true;
        $user->balance = 0;

        if($user->secureSave())
        {
            return $this->response($user);
        }
        else
        {
            return $this->internalErrorResponse();
        }
    }
}
