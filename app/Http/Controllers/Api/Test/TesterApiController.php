<?php

namespace App\Http\Controllers\Api\Test;

use App\Http\Controllers\Controller;
use App\Service\XenditBalanceService;
use App\Service\XenditTransactionService;
use Illuminate\Http\Request;

class TesterApiController extends Controller
{
    private $service1;
    private $service2;
    public function __construct()
    {
        $this->service1 = new XenditBalanceService;
        $this->service2 = new XenditTransactionService;
    }
    function getBalance()
    {

        return $this->service1->getBalance();
    }

    function getAllChannel()
    {

        return $this->service2->getAllChannel();
    }
}
