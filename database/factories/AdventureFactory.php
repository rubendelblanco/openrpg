<?php

use Faker\Generator as Faker;

$factory->define(App\Adventure::class, function (Faker $faker) {
    return [
        'campaign_id' => function() {
            return factory(App\Campaign::class)->create();
        },
        'title' => $faker->sentence,
    ];
});
