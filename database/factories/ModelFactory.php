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

$factory->define(CodeProject\Entities\User::class, function (Faker\Generator $faker) {
    return [
        'name' => 'james',
        'email' => 'jamesfrj@yahoo.com.br',
        'password' => 123456,
        'remember_token' => '123456',

//        'name' => $faker->name,
//        'email' => $faker->email,
//        'password' => bcrypt(str_random(10)),
//        'remember_token' => str_random(10),
    ];
});

$factory->define(CodeProject\Entities\Client::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'responsible' => $faker->name,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'obs' => $faker->sentence,
    ];
});

$factory->define(CodeProject\Entities\Project::class, function (Faker\Generator $faker) {
    return [
        'owner_id' => 1,
        'client_id' => $faker->numberBetween(1,4),
        'name' => $faker->name,
        'description' => $faker->sentence,
        'progress' => $faker->numberBetween(0,100),
        'status' => $faker->randomElement($array = array('Opened', 'Assigned', 'In Progress', 'Canceled', 'Finished')),
        'due_date' => $faker->date('Y-m-d'),
    ];
});

