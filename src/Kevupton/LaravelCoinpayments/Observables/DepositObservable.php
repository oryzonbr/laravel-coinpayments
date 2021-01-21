<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 24/03/2018
 * Time: 6:17 PM
 */

namespace Oryzonbr\LaravelCoinpayments\Observables;

use Oryzonbr\LaravelCoinpayments\Enums\IpnStatus;
use Oryzonbr\LaravelCoinpayments\Events\Deposit\DepositComplete;
use Oryzonbr\LaravelCoinpayments\Events\Deposit\DepositCreated;
use Oryzonbr\LaravelCoinpayments\Events\Deposit\DepositUpdated;
use Oryzonbr\LaravelCoinpayments\Models\Deposit;

class DepositObservable
{
    public function updated (Deposit $deposit)
    {
        event(new DepositUpdated($deposit));
        $this->checkStatus($deposit);
    }

    public function created (Deposit $deposit)
    {
        event(new DepositCreated($deposit));
        $this->checkStatus($deposit);
    }

    private function checkStatus (Deposit $deposit)
    {
        if (IpnStatus::isComplete($deposit->status)) {
            event(new DepositComplete($deposit));
        }
    }
}