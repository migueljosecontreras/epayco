<?php

namespace App\Services;

use App\Traits\Common\RequestServiceTrait;

class RechargeService
{
    use RequestServiceTrait;

    public $baseUri;
    public $request;

    public function __construct()
    {
        $this->baseUri = config('service.apirest.url').'/api/v1';
        $this->request = app('request');
    }

    public function index($headers = []) : array
    {
        return $this->request($this->request->method(), '/recharge', [], $headers);
    }

    public function store($formData, $headers = []) : array
    {
        return $this->request($this->request->method(), '/recharge',$formData, $headers);
    }
}
