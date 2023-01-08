<?php

namespace App\Http\Controllers;

use App\Services\RechargeService;
use App\Traits\Common\RequestServiceTrait;
use Illuminate\Http\Request;

class RechargeController extends Controller
{
    use RequestServiceTrait;

    private $rechargeService;

    public function __construct(RechargeService $rechargeService)
    {
        $this->rechargeService = $rechargeService;
    }

    public function index(){
        return call_user_func_array([$this, 'requestResponse'], array_values($this->rechargeService->index()));
    }

    public function store(Request $request){
        return call_user_func_array([$this, 'requestResponse'], array_values($this->rechargeService->store($request->only(['document', 'phone', 'amount']))));
    }
}
