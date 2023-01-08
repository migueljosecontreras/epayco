<?php

namespace App\Traits\Common;

use Illuminate\Support\Facades\Http;

trait RequestServiceTrait
{
    public function request($method, $requestUrl, $formParams = [], $headers = []) : array
    {
        try
        {
            $token  = app('request')->bearerToken();
            $client = Http::withHeaders(array_merge($headers, $token ? [ 'Authorization' => 'Bearer '.$token ] : []));

            $response = $client->{strtolower($method)}($this->baseUri.$requestUrl, $formParams);

            return [
                'data' => $response->json(),
                'code' => $response->status(),
            ];
        }
        catch(\Exception $e)
        {
            return [
                'data' => [
                    'success'       => false,
                    'cod_error'     => '50',
                    'message_error' => $e->getMessage(),
                    'message'       => $e->getMessage(),
                    'data'          => null,
                ],
                'code' => 500,
            ];
        }
    }
}
