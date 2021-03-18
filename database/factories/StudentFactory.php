<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Student;
use Faker\Generator as Faker;

$factory->define(\App\Models\Student::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\User::class),
        'name' => function (array $post) {
            return App\User::find($post['user_id'])->name;
        },
        'nis' => $faker->localIpv4,
        'nisn' => $faker->numberBetween($min = 1000000000, $max = 9999999999),
        'gender' => $faker->randomElement(['l', 'p']),
        'phone' => $faker->e164PhoneNumber,
    ];
});
