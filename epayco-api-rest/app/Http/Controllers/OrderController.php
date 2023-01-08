<?php

namespace App\Http\Controllers;

use App\Mail\NewOrder;
use App\Models\Order;
use App\Models\User;
use App\Services\EmailService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::byUser()->get();

        return $this->response($orders);
    }

    public function store(Request $request)
    {
        $validator = validator($request->all(), Order::rules());

        if($validator->fails())
        {
            return $this->validationErrorResponse($validator->errors());
        }

        $user = User::findUser()->first();

        $order = new Order([ 'user_id' => $user->id, 'amount' => $request->amount, 'completed' => false, 'token' => \Str::random(6) ]);

        if($order->secureSave())
        {
            EmailService::send($user->email, new NewOrder($user, $order));

            return $this->response($order, trans('general.msg.orderCreated'));
        }
        else
        {
            return $this->internalErrorResponse();
        }
    }

    public function complete(Request $request)
    {
        $validator = validator($request->all(), [
            'id'    => 'required|integer|exists:orders,id,deleted_at,NULL',
            'token' => 'required|string|exists:orders,token,deleted_at,NULL',
        ]);

        if($validator->fails())
        {
            return $this->validationErrorResponse($validator->errors());
        }

        $currentUser = \Auth::user();

        $order = Order::with('user')
                      ->where('id', '=', $request->id)
                      ->where('token', '=', $request->token);

        if($currentUser->role != 'admin')
        {
            $order = $order->where('user_id', '=', $currentUser->id);
        }

        $order = $order->first();

        if(!$order)
        {
            return $this->notFoundResponse();
        }

        if($order->completed)
        {
            return $this->response($order, trans('general.msg.orderAlreadyCompleted'));
        }

        $user = $order->user;

        if($user->balance < $order->amount)
        {
            return $this->validationErrorResponse([ 'user' => trans('validation.balanceIsNotEnough') ]);
        }

        $order->completed = true;

        if($order->secureSave())
        {
            $user->update([
                              'balance' => $user->balance - $order->amount,
                          ]);

            $order->load('user');

            return $this->response($order, trans('general.msg.orderCompleted'));
        }
        else
        {
            return $this->internalErrorResponse();
        }
    }
}
