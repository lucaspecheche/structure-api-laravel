<?php
use App\Domain\Models\Role;
use Faker\Generator as Faker;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'name' => $faker->jobTitle,
        'slug' => $faker->unique()->slug
    ];
});
