<?php

use Faker\Generator as Faker;

$factory->define(App\Campaign::class, function (Faker $faker) {
    return [
        'gamemaster_id' => function() {
            return factory(App\User::class)->create();
        },
        'title' => $faker->sentence,
    ];
});
