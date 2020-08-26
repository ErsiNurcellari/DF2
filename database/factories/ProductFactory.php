<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Product::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'description' => $faker->paragraph,
        'user_id' => function() {
            return factory(App\Models\User::class)->create()->id;
        },
        'price' => $faker->numberBetween(10, 100)
    ];
});
