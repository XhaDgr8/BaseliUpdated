<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Synonyms;
use Faker\Generator as Faker;

$factory->define(Synonyms::class, function (Faker $faker) {
    return [
        'word_id' => $faker->numberBetween(-100000, 100000),
        'syno_id' => $faker->numberBetween(-100000, 100000),
    ];
});
