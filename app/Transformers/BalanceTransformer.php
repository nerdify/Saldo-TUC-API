<?php

namespace App\Transformers;

use App\Balance;
use League\Fractal\TransformerAbstract;

class BalanceTransformer extends TransformerAbstract
{
    /**
     * Transform Balance.
     *
     * @param Balance $balance
     *
     * @return array
     */
    public function transform(Balance $balance)
    {
        return [
            'id'       => (int) $balance->id,
            'balance'  => $balance->balance,
            'spending' => $balance->spending,
            'created'  => $balance->created_at->toIso8601String(),
        ];
    }
}
