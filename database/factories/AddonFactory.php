<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Addon::class, function (Faker $faker) {
    return [
        'name' => $faker->title,
        'description' => $faker->paragraph
    ];
});
