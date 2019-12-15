<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Wallet;
use Faker\Generator as Faker;

$factory->define(Wallet::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'balance' => 1000000
    ];
});
