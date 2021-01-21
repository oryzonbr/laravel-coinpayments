<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 24/03/2018
 * Time: 6:17 PM
 */

namespace Oryzonbr\LaravelCoinpayments\Observables;

use Oryzonbr\LaravelCoinpayments\Enums\IpnStatus;
use Oryzonbr\LaravelCoinpayments\Events\Transaction\TransactionComplete;
use Oryzonbr\LaravelCoinpayments\Events\Transaction\TransactionCreated;
use Oryzonbr\LaravelCoinpayments\Events\Transaction\TransactionUpdated;
use Oryzonbr\LaravelCoinpayments\Models\Transaction;

class TransactionObservable
{
    public function updated (Transaction $transaction)
    {
        event(new TransactionUpdated($transaction));
        $this->checkStatus($transaction);
    }

    public function created (Transaction $transaction)
    {
        event(new TransactionCreated($transaction));
        $this->checkStatus($transaction);
    }

    private function checkStatus (Transaction $transaction)
    {
        if (IpnStatus::isComplete($transaction->status)) {
            event(new TransactionComplete($transaction));
        }
    }
}