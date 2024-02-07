<?php

namespace App\Service; // Change the name

use Illuminate\Support\Env;

final class XenditAuthService
{
    static function bearer()
    {
        $secret = env('XENDIT_KEY');
        $encoded_secret = base64_encode($secret . ':');

        return 'Basic ' . $encoded_secret;
    }
}
