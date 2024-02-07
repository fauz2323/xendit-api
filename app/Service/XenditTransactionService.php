<?php

namespace App\Service;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

final class XenditTransactionService
{
    function getAllChannel()
    {
        $request = Http::withHeaders([
            'Authorization' => XenditAuthService::bearer(),
        ])->get('https://api.xendit.co/payouts_channels');

        return $request->json();
    }

    function TransactionOutRequest($idempotency, $data)
    {
        $header = [
            'Authorization' => XenditAuthService::bearer(),
            'Idempotency-key' => $idempotency,
        ];

        $body = [
            'reference_id' => $data['reference_id'],
            'channel_code' => $data['channel_code'],
        ];
    }

    function createVa()
    {
        $dateNow = Carbon::now()->modify('+3 hours')->toIso8601String();
        $header = [
            'Authorization' => XenditAuthService::bearer(),
            'content-type' => 'application/json',
        ];

        $body = [
            'external_id' => 'unique code',
            'bank_code' => 'code channel',
            'name' => 'nama',
            'currency' => 'IDR',
            'is_single_use' => 'true',
            'is_closed' => 'true',
            'expected_amount' => 'amount',
            'expiration_date' => $dateNow
        ];

        $request = Http::withHeaders($header)->post('https://api.xendit.co/virtual_accounts', $body);

        return $request->json();
    }

    function createQrisQr()
    {
        $dateNow = Carbon::now()->modify('+3 hours')->toIso8601String();
        $header = [
            'Authorization' => XenditAuthService::bearer(),
            'content-type' => 'application/json',
            'api-version' => '2022-07-31',
            'idempotency-key' => 'idempotency-key'
        ];

        $body = [
            'reference_id' => 'unique code',
            'type' => 'DYNAMIC',
            'currency' => 'IDR',
            'amount' => 'amount',
            'expiration_date' => $dateNow
        ];

        $request = Http::withHeaders($header)->post('https://api.xendit.co/qr_codes', $body);

        return $request->json();
    }
}
