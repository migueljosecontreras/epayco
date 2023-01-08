<?php

namespace App\Helpers\Common;

class JWT {
    /*
     * Hago ésta functión porque jwt hubo un caso donde cambié un número del signature de "8" a "9"
     * y la petición pasó correctamente, si la cambiaba por otro número, si daba error, pero específicamente con ese pequeño cambio que hice
     * me hizo dudar de la validez de jwt para validar el token, por lo que decidí añadir un extra de validación manual que no le hace daño a nadie
     */
    public static function validateJWTSignature($token) : bool{
        $jwt = self::getJWTParts($token);

        $my_signature = Str::base64_url_encode(hash_hmac('sha256', $jwt['header'].'.'.$jwt['payload'], env('JWT_SECRET'), true));

        return $jwt['signature'] == $my_signature;
    }

    public static function validateJWTExpireData($token) : bool{
        $payload = self::geJWTPayload($token);

        $expire_date = $payload['exp'];

        return time() <= $expire_date;
    }

    public static function getJWTPayloadData($token){
        return \Arr::except(self::geJWTPayload($token), ['iss', 'iat', 'exp', 'nbf', 'jti', 'sub', 'prv']);
    }

    public static function geJWTPayload($token){
        return json_decode(base64_decode(self::getJWTParts($token)['payload']),true);
    }

    public static function getJWTParts($token) : array
    {
        $token_parts = explode('.', $token);

        return [
            'header' => $token_parts[0],
            'payload' => $token_parts[1],
            'signature' => $token_parts[2]
        ];
    }
}


