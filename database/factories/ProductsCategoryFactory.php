<?php

use Faker\Generator as Faker;

$factory->define(App\ProductsCategory::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'short_description' => $faker->paragraph(1, true),
        'titleSEO' => $faker->word,
        'descriptionSEO' => $faker->paragraph(1, true),
        'keywordsSEO' => $faker->words(5, true),
    ];
});
