<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\BlogPost;
use Faker\Generator as Faker;

$factory->define(BlogPost::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(10),
        'content' => $faker->paragraphs(5, true),
        'created_at' => $faker->dateTimeBetween('-6 months')
    ];
});

$factory->state(App\BlogPost::class, 'new-title', function (Faker $faker) {
    return [
        'title' => 'Test title',
        'content' => 'Test content 10 words!'
    ];
});

$factory->state(App\BlogPost::class, 'wrong-title', function (Faker $faker) {
    return [
        'title' => '1',
        'content' => '!'
    ];
});
