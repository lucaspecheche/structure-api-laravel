<?php

use App\Domain\Models\Permission;
use Faker\Generator as Faker;

$factory->define(Permission::class, function (Faker $faker) {
    return [
        'slug' => $faker->unique()->slug,
        'description' => $faker->text(15)
    ];
});
