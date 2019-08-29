<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'content' => $faker->realText(70, 1),
        'created_at' => $faker->dateTimeBetween('-3 months')
    ];
});
