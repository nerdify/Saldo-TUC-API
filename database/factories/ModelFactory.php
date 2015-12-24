<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Card::class, function ($faker) {
    return [
        'number' => "{$faker->randomNumber(8, true)}",
    ];
});

$factory->define(App\Balance::class, function ($faker) {
    return [
        'balance' => $faker->randomDigit,
        'spending' => $faker->randomDigit,
    ];
});

$factory->define(App\Notification::class, function ($faker) {
    return [
        'received' => false,
    ];
});