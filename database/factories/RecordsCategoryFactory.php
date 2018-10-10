<?php

use Faker\Generator as Faker;

$factory->define(App\RecordsCategory::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
    ];
});
