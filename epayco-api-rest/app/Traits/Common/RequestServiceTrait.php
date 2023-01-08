<?php

namespace App\Traits\Common;

use Illuminate\Support\Facades\Http;
use App\Traits\Common\ApiResponseTrait;
trait RequestServiceTrait
{
    use ApiResponseTrait;
    public function request($method, $requestUrl, $formParams = [], $headers = [], $file = null) : array
    {
        try
        {
            $token = app('request')->bearerToken();
            $client = Http::withHeaders(array_merge($headers, $token ? ['Authorization' => 'Bearer '.$token] : []));
            if($file){
                $client->attach($file['file_key'], $file['content'], $file['name']);
            }
            if(!$file && $formParams){
                $response = $client->asForm()->{strtolower($method)}($this->baseUri.$requestUrl, $formParams);}
            else {
                $response = $client->{strtolower($method)}($this->baseUri.$requestUrl, $formParams);
            }
            return [
                'data' => ($response->json() == null && $response->status() == 500) ? json_decode($this->internalErrorResponse()->content(),true) : $response->json(),
                'code' => $response->status() == 500 ? $this->internalErrorResponse()->status() : $response->status()
            ];
        }
        catch(\Exception $e)
        {
            return [
                'data'  => [
                    'msg' => $e->getMessage()
                ],
                'code' => 500,
            ];
        }
    }
}
