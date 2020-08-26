<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Term::class, function (Faker $faker) {
    return [
        'name' => $faker->text(30),
        'slug' => str_slug($faker->text(30))
    ];
});
