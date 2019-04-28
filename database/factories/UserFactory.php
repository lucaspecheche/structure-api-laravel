<?php

use Faker\Generator as Faker;
use App\Domain\Models\User;
use Faker\Provider\pt_BR;

$factory->define(User::class, function (Faker $faker) {
    $faker->addProvider(new pt_BR\Person($faker));

    return [
        'firstName' => $faker->firstName,
        'lastName' => $faker->lastName,
        'cpf' => $faker->unique()->cpf(false),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10)
    ];
});
