<?php

use Faker\Generator as Faker;

$factory->define(App\Record::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'short_description' => $faker->sentence(3, true),
        'description' => $faker->paragraph(4, true),
        'category_id' => $faker->biasedNumberBetween(1, 15),
    ];
});
