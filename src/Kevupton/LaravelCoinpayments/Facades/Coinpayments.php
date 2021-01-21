<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 19/09/2017
 * Time: 1:14 PM
 */

namespace Oryzonbr\LaravelCoinpayments\Facades;

use Illuminate\Support\Facades\Facade;
use Oryzonbr\LaravelCoinpayments\Providers\LaravelCoinpaymentsServiceProvider;

class Coinpayments extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return LaravelCoinpaymentsServiceProvider::SINGLETON; }
}