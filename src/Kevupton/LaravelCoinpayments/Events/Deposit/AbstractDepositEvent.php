<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 24/03/2018
 * Time: 8:13 PM
 */

namespace Oryzonbr\LaravelCoinpayments\Events\Deposit;

use Oryzonbr\LaravelCoinpayments\Events\Event;
use Oryzonbr\LaravelCoinpayments\Models\Deposit;

abstract class AbstractDepositEvent extends Event
{
    /**
     * @var Deposit
     */
    public $deposit;

    public function __construct (Deposit $deposit)
    {
        $this->deposit = $deposit;
    }
}