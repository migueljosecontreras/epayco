<?php

namespace App\Services;

use App\Traits\Common\RequestServiceTrait;

class UserService
{
    use RequestServiceTrait;

    public $baseUri;
    public $request;

    public function __construct()
    {
        $this->baseUri = config('service.apirest.url').'/api/v1';
        $this->request = app('request');
    }

    public function balance($formData,$headers = []) : array
    {
        return $this->request($this->request->method(), '/user/balance', $formData, $headers);
    }
}
