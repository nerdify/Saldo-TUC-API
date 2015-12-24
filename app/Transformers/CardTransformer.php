<?php

namespace App\Transformers;

use App\Card;
use League\Fractal\TransformerAbstract;

class CardTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'balances',
        'current_balance',
    ];

    /**
     * Transform Card
     *
     * @param Card $card
     * @return array
     */
    public function transform(Card $card)
    {
        return [
            'id' => (int) $card->id,
            'number' => $card->number,
            'created_at' => $card->created_at->toIso8601String(),
        ];
    }

    /**
     * Include Balance
     *
     * @param Card $card
     * @return \League\Fractal\Resource\Collection
     */
    public function includeBalances(Card $card)
    {
        return $this->collection($card->balances, new BalanceTransformer);
    }

    /**
     * Include Current Balance
     *
     * @param Card $card
     * @return \League\Fractal\Resource\Item
     */
    public function includeCurrentBalance(Card $card)
    {
        $balance = $card->balances->last();

        return $this->item($balance, new BalanceTransformer);
    }
}