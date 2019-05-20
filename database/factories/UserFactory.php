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
        'password' => bcrypt(rand(1,20)),
        'active'   => true,
        'code' => str_random(10)
    ];
});
