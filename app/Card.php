<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'number'
    ];

    /**
     * A card has many balances.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function balances()
    {
        return $this->hasMany(Balance::class);
    }

    /**
     * A card has many notifications.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * Add new balance.
     *
     * @param float|int $balance
     * @return Model
     */
    public function addBalance($balance)
    {
        $currentBalance = $this->balances()->latest()->first();

        if ($currentBalance && $currentBalance->balance == $balance) {
            return $currentBalance;
        }

        return $this->balances()->save(new Balance([
            'balance' => $balance,
            'spending' => $this->calculateSpending($balance, $currentBalance),
        ]));
    }

    /**
     * @param $balance
     * @param $currentBalance
     * @return int|mixed
     */
    private function calculateSpending($balance, $currentBalance)
    {
        return $currentBalance ? max($currentBalance->balance - $balance, 0) : 0;
    }
}
