<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'price' => $faker->randomFloat(2, 0, 1000000),
        'short_description' => $faker->paragraph(1, true),
        'description' => $faker->paragraph(5, true),
        'most_saled' => $faker->biasedNumberBetween(0, 15),
        'promo_action' => $faker->biasedNumberBetween(0, 1),
        'novelty' => $faker->biasedNumberBetween(0, 1),
        'best' => $faker->biasedNumberBetween(0, 1),
        'category_id' => $faker->biasedNumberBetween(1, 10),
    ];
});
