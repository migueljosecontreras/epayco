<?php

namespace App\Services;

use App\Traits\Common\RequestServiceTrait;

class AuthService
{
    use RequestServiceTrait;

    public $baseUri;
    public $request;

    public function __construct()
    {
        $this->baseUri = config('service.apirest.url').'/api/v1';
        $this->request = app('request');
    }

    public function login($formData, $headers = []) : array
    {
        return $this->request($this->request->method(), '/login', $formData, $headers);
    }

    public function register($formData, $headers = []) : array
    {
        return $this->request($this->request->method(), '/register',$formData, $headers);
    }
}
