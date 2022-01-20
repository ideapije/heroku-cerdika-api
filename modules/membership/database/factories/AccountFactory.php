<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Modules\Membership\Account;
use Modules\Membership\Province;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Account::class, function (Faker $faker) {
    $gender = $faker->randomElement(['male', 'female']);
    $firstName = $gender === 'male' ? $faker->firstNameMale : $faker->firstNameFemale;
    static $id = 1;
    $email = $id <= 3 ? "admin$id@mail.com" : $faker->unique()->safeEmail;
    return [
        'id' => $id++,
        'name' => "$firstName $faker->lastName",
        'email' => $email,
        'email_verified_at' => now(),
        'password' => bcrypt('Pass^123'),
        'remember_token' => Str::random(10),
    ];
});

$factory->afterCreating(Account::class, function ($user, $faker) {
    if ($user->id <= 3) {
        $user->assignRole('admin');
    } else {
        $user->assignRole('member');
    }
    $gender = $faker->randomElement(['female', 'male']);
    $names = collect(preg_split("/[\s]+/", $user->name));
    $lastName = $names->filter(function ($val, $index) {
        return $index > 0;
    })->join(' ');
    $member = $user->membership()->create([
        'first_name' => $names->first(),
        'last_name' => $lastName,
        'uuid' => $faker->uuid,
        'phone' => $faker->phoneNumber,
        'image' => null,
        'gender' => $gender,
        'verified' => $faker->boolean
    ]);
    $province = Province::all()->random();
    $member->addresses()->create([
        'address' => $faker->address,
        'province_id' => $province->id,
        'city_id' => $province->cities->random()->id ?? null,
        'subdistrict_id' => $province->cities->random()->subdistricts->random()->id ?? null
    ]);
});
