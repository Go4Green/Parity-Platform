<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\KwhCost;
use Faker\Generator as Faker;

$factory->define(KwhCost::class, function (Faker $faker) {
    return [
        'demand' => 6000,
        'res_capacity' => 4000,
        'cost' => 2
    ];
});
