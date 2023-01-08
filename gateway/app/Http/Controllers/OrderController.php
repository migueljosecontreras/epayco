<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use App\Traits\Common\RequestServiceTrait;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use RequestServiceTrait;

    private $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(){
        return call_user_func_array([$this, 'requestResponse'], array_values($this->orderService->index()));
    }

    public function store(Request $request){
        return call_user_func_array([$this, 'requestResponse'], array_values($this->orderService->store($request->only(['document', 'phone', 'amount']))));
    }

    public function complete(Request $request){
        return call_user_func_array([$this, 'requestResponse'], array_values($this->orderService->complete($request->only(['id', 'token']))));
    }
}
