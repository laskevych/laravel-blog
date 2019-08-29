<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => Hash::make('12345678'), // password
        'api_token' => Str::random(80),
        'remember_token' => Str::random(10),
    ];
});

$factory->state(User::class, 'custom-user', function(Faker $faker) {
    return [
        'name' => 'Andrew Black',
        'email' => 'test@gmail.com',
        'email_verified_at' => now(),
        'password' => Hash::make('12345678'),
        'api_token' => Str::random(80),
        'remember_token' => Str::random(10),
        'is_admin' => true
    ];

});
