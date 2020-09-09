<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Guru;
use App\User;
use Faker\Generator as Faker;

$factory->define(Guru::class, function (Faker $faker) {
    $gender = ['Laki-Laki', 'Perempuan'];
    return [
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'nip' => $faker->unique()->nik,
        'no_telp' => $faker->unique()->phoneNumber,
        'jenkel' => $faker->randomElement($gender),
        'agama' => 'Islam',
        'dob' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'alamat' => $faker->address,
        'foto' => $faker->imageUrl($width = 640, $height = 480),
        'pendidikan' => 'S.Pd'
    ];
});
