<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Address::class, function (Faker\Generator $faker) {

    return [
        'address' => $faker->streetAddress,
        'city' => $faker->city,
        'state' => $faker->state,
        'country' => $faker->state,
        'postal_code' => $faker->postcode
    ];
});

$factory->define(App\Seller::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
        'last_name' => $faker->lastName,
        'address_id' => function() {
        	return factory(App\Address::class)->create()->id;
        }
    ];
});

$factory->define(App\Review::class, function (Faker\Generator $faker) {

    return [
        'reviewer_name' => $faker->name,
        'title' => $faker->sentence(6, true),
        'content' => $faker->text(150),
        'date' => $faker->date
    ];
});

$factory->define(App\Product::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->word,
        'description' => $faker->text($maxNbChars = 150),
        'price' => $faker->randomNumber(2)
    ];
});

$factory->define(App\Tag::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->word
    ];
});
