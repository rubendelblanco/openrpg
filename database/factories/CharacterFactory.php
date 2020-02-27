<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;

$factory->define(App\Character::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class)->create()->id,
        'name' => $faker->name(),
        'experience' => $faker->biasedNumberBetween(50000, 60000),
        'level' => $faker->biasedNumberBetween(4, 6),
    ];
});
