<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Balance extends Model
{
    use SoftDeletes;

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'balance',
        'spending',
    ];

    /**
     * Divide by 100 because we store in decimals.
     *
     * @param $balance
     *
     * @return float
     */
    public function getBalanceAttribute($balance)
    {
        return $balance / 100;
    }

    /**
     * Multiply by 100 because we store in decimals.
     *
     * @param $balance
     */
    public function setBalanceAttribute($balance)
    {
        $this->attributes['balance'] = $balance * 100;
    }

    /**
     * Divide by 100 because we store in decimals.
     *
     * @param $spending
     *
     * @return float
     */
    public function getSpendingAttribute($spending)
    {
        return $spending / 100;
    }

    /**
     * Multiply by 100 because we store in decimals.
     *
     * @param $spending
     */
    public function setSpendingAttribute($spending)
    {
        $this->attributes['spending'] = $spending * 100;
    }
}
