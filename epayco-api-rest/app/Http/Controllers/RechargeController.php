<?php

namespace App\Http\Controllers;

use App\Models\Recharge;
use App\Models\User;
use Illuminate\Http\Request;

class RechargeController extends Controller
{
    public function index(Request $request)
    {
        $recharges = Recharge::byUser()->get();
        return $this->response($recharges);
    }

    public function store(Request $request)
    {
        $validator = validator($request->all(), Recharge::rules());

        if($validator->fails())
        {
            return $this->validationErrorResponse($validator->errors());
        }

        $user = User::findUser()->first();

        if(!$user)
        {
            return $this->notFoundResponse(trans('general.msg.userNotFound'));
        }

        $recharge = new Recharge(['user_id' => $user->id, 'amount' => $request->amount]);

        if($recharge->secureSave())
        {
            $user->update([
                              'balance' => $user->balance + $request->amount,
                          ]);

            return $this->response($recharge);
        }
        else
        {
            return $this->internalErrorResponse();
        }
    }
}
