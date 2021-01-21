<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 25/03/2018
 * Time: 9:46 PM
 */

namespace Oryzonbr\LaravelCoinpayments\Events\Transaction;

use Oryzonbr\LaravelCoinpayments\Events\Event;
use Oryzonbr\LaravelCoinpayments\Models\Transaction;

class AbstractTransactionEvent extends Event
{
    /**
     * @var Transaction
     */
    public $transaction;

    public function __construct (Transaction $transaction)
    {
        $this->transaction = $transaction;
    }
}