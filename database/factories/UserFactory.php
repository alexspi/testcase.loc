<?php

namespace Database\Factories;

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(\App\Models\User::class, function (Faker $faker) {
    static $password;
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => $password ?: $password = bcrypt('secret'), // password
        'remember_token' => Str::random(10),
    ];
});
