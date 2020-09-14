<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\DetailSoal;
use Faker\Generator as Faker;

$factory->define(DetailSoal::class, function (Faker $faker) {
    $n = 1;
    return [
        'soal_id' => $n++,
        'soal' => $faker->sentence,
        'randomize' => $faker->randomNumber
    ];
});
