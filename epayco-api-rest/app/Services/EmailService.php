<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;


class EmailService {
    public static function send($to, $template)
    {
        Mail::to(env('MAIL_DEBUG') ? env('MAIL_FROM_ADDRESS_DEBUG') : $to)->send($template);
    }
}
