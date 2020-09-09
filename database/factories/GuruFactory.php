<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Guru;
use Faker\Generator as Faker;

$factory->define(Guru::class, function (Faker $faker) {
    $gender = ['Laki-Laki', 'Perempuan'];
    return [
        'nip' => $faker->unique()->nik,
        'no_telp' => $faker->unique()->mobileNumber,
        'jenkel' => $faker->randomElement($gender),
        'agama' => 'Islam',
        'dob' => $faker->date($max = 'now'),
        'alamat' => $faker->address,
        'foto' => $faker->imageUrl($width = 640, $height = 480),
        'pendidikan' => 'S.Pd'
    ];
});
