<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 25/03/2018
 * Time: 9:13 PM
 */

namespace Oryzonbr\LaravelCoinpayments\Events\Withdrawal;

use Oryzonbr\LaravelCoinpayments\Events\Event;
use Oryzonbr\LaravelCoinpayments\Models\Withdrawal;

class AbstractWithdrawalEvent extends Event
{
    /**
     * @var Withdrawal
     */
    public $withdrawal;

    public function __construct (Withdrawal $withdrawal)
    {
        $this->withdrawal = $withdrawal;
    }
}