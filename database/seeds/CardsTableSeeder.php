<?php

use App\Balance;
use App\Card;
use Illuminate\Database\Seeder;

class CardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Card::class, 10)->create()
            ->each(function ($card) {
                $card->balances()->saveMany(factory(Balance::class, 20)->make());
            });
    }
}
