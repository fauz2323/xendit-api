<?php

namespace App\Service;

use Illuminate\Support\Facades\Http;

final class XenditBalanceService
{
    function getBalance()
    {
        $header = [
            'Authorization' => XenditAuthService::bearer(),
        ];

        $request = Http::withHeaders($header)->get('https://api.xendit.co/balance');

        return $request->json();
    }
}
