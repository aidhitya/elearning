<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Murid;
use App\User;
use Faker\Generator as Faker;

$factory->define(Murid::class, function (Faker $faker) {
    $gender = ['Laki-Laki', 'Perempuan'];
    return [
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'nis' => $faker->unique()->postcode,
        'no_telp' => $faker->unique()->phoneNumber,
        'jenkel' => $faker->randomElement($gender),
        'agama' => 'Islam',
        'dob' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'alamat' => $faker->address,
        'foto' => $faker->imageUrl($width = 640, $height = 480)
    ];
});
