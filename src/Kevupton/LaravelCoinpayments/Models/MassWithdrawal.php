<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 19/09/2017
 * Time: 12:31 PM
 */

namespace Oryzonbr\LaravelCoinpayments\Models;
use Illuminate\Support\Collection;

/**
 * Class Transaction
 *
 * @package Oryzonbr\LaravelCoinpayments\Models
 * @property mixed                   id
 * @property mixed                   created_at
 * @property mixed                   updated_at
 * @property Withdrawal[]|Collection $withdrawals
 */
class MassWithdrawal extends Model
{
    public function withdrawals ()
    {
        return $this->hasMany(Withdrawal::class);
    }
}