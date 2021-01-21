<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 24/03/2018
 * Time: 6:17 PM
 */

namespace Oryzonbr\LaravelCoinpayments\Observables;

use Oryzonbr\LaravelCoinpayments\Enums\WithdrawalStatus;
use Oryzonbr\LaravelCoinpayments\Events\Withdrawal\WithdrawalComplete;
use Oryzonbr\LaravelCoinpayments\Events\Withdrawal\WithdrawalCreated;
use Oryzonbr\LaravelCoinpayments\Events\Withdrawal\WithdrawalUpdated;
use Oryzonbr\LaravelCoinpayments\Models\Withdrawal;

class WithdrawalObservable
{
    public function updated (Withdrawal $withdrawal)
    {
        event(new WithdrawalUpdated($withdrawal));
        $this->checkStatus($withdrawal);
    }

    public function created (Withdrawal $withdrawal)
    {
        event(new WithdrawalCreated($withdrawal));
        $this->checkStatus($withdrawal);
    }

    private function checkStatus (Withdrawal $withdrawal)
    {
        if (WithdrawalStatus::COMPLETE  === $withdrawal->status) {
            event(new WithdrawalComplete($withdrawal));
        }
    }
}