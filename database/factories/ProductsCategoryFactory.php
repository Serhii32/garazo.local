<?php

use Faker\Generator as Faker;

$factory->define(App\ProductsCategory::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
    ];
});
