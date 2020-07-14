<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Word;
use Faker\Generator as Faker;

$factory->define(Word::class, function (Faker $faker) {
    return [
        'word' => $faker->word,
        'countary' => $faker->word,
        'language' => $faker->word,
        'meaning' => $faker->word,
        'defination' => $faker->text,
    ];
});
