<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\RealEstate;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(RealEstate::class, function (Faker $faker) {

    $strings = array(
        'sale',
        'rental',
    );

    $name = $faker->name;

    return [
        'name' => $name,
        'user_id' => 1,
        'type' => $strings[array_rand($strings)],
        'address' => $faker->address,
        'price' => mt_rand(1000,950000),
        'bedroom' => mt_rand(1,6),
        'bathroom' => mt_rand(1,6),
        'wc' => mt_rand(1,6),
        'area' => mt_rand(100,250),
        'description' => $faker->paragraph,
        'slug'=> Str::slug($name),
    ];
});
