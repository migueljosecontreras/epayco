<?php

namespace App\Services;

use App\Traits\Common\RequestServiceTrait;

class OrderService
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
        return $this->request($this->request->method(), '/order', [], $headers);
    }

    public function store($formData, $headers = []) : array
    {
        return $this->request($this->request->method(), '/order',$formData, $headers);
    }

    public function complete($formData, $headers = []) : array
    {
        return $this->request($this->request->method(), '/order/complete',$formData, $headers);
    }
}
