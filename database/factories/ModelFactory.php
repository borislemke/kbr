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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'username' => $faker->userName,
        'email' => $faker->email,
        'password' => '$2y$10$lcg22GUn8q7ZsP7jWhLaw.MIuvgv/OEZfxaxB6qRvonx/4HgdEhCe',
        'remember_token' => str_random(10),
        'role_id' => 1,
        'position_id' => 1,
        'branch_id' => 1,
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'city' => 'Denpasar',
        'province' => 'Bali',
        'country' => 'Indonesia',
        'zipcode' => $faker->postcode,
        'image' => 'user.jpg',
        'active' => 1
    ];
});

$factory->define(App\Testimmony::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->title,
        'content' => $faker->sentence($nbWords = 3, $variableNbWords = true)
    ];
});

$factory->define(App\Customer::class, function (Faker\Generator $faker) {
    return [        
        'username' => $faker->userName,
        'email' => $faker->email,
        'password' => '$2y$10$lcg22GUn8q7ZsP7jWhLaw.MIuvgv/OEZfxaxB6qRvonx/4HgdEhCe',
        'remember_token' => str_random(10),
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'city' => 'Denpasar',
        'province' => 'Bali',
        'country' => 'Indonesia',
        'zipcode' => $faker->postcode,
        'image_profile' => 'customer.jpg',
        'newsletter' => 1,
        'active' => 1
    ];
});

$factory->define(App\Inquiry::class, function (Faker\Generator $faker) {
    return [    
        'property_id' => rand(1, 100),
        'subject' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'content' => $faker->paragraph($nbSentences = 6, $variableNbSentences = true),
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'phone' => $faker->phoneNumber,
        'email' => $faker->email
    ];
});

$factory->define(App\Branch::class, function (Faker\Generator $faker) {
    return [
        'name' => 'Denpasar'
    ];
});

$factory->define(App\PostCategory::class, function (Faker\Generator $faker) {
    return [
        'parent' => 0,
        'order' => 1
    ];
});

$factory->define(App\PostCategoryLanguage::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->word,
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'locale' => 'en'
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
        'category_id' => 1,
        'status' => 1
    ];
});

$factory->define(App\PostLanguage::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'content' => $faker->paragraph($nbSentences = 6, $variableNbSentences = true),
        'locale' => 'en'
    ];
});

$factory->define(App\Property::class, function (Faker\Generator $faker) {
    return [
        'category_id' => 1,
        'currency' => $faker->randomElement($array = array ('IDR', 'USD', 'EUR')),
        'price' => $faker->randomNumber(7),
        'discount' => $faker->randomNumber(2),
        'type' => $faker->randomElement($array = array ('for sale', 'for rent')),
        'publish' => $faker->randomElement($array = array ('draft', 'moderation', 'publish')),
        'building_size' => $faker->randomNumber(2),
        'land_size' => $faker->randomNumber(3),
        'sold' => $faker->randomElement([0, 1]),
        'status' => $faker->randomElement([-1, 0, 1]),
        'year' => $faker->year($max = 'now'),
        'view' => $faker->randomDigit,

        'map_latitude' => rand(8082268, 8842932) / 1000000,
        'map_longitude' => rand(114443923, 115689498) / 1000000,

        'view_north' => $faker->sentence($nbWords = 3, $variableNbWords = true),
        'view_east' => $faker->sentence($nbWords = 3, $variableNbWords = true),
        'view_west' => $faker->sentence($nbWords = 3, $variableNbWords = true),
        'view_south' => $faker->sentence($nbWords = 3, $variableNbWords = true),

        'is_price_request' => $faker->randomElement([0, 1]),
        'is_exclusive' => $faker->randomElement([0, 1]),

        'owner_name' => $faker->name,
        'owner_email' => $faker->email,
        'owner_phone' => $faker->phoneNumber,

        'agent_commission' => $faker->randomNumber(7),
        'agent_contact' => $faker->name,
        'agent_meet_date' => $faker->date($format = 'Y-m-d', $min = 'now'),
        'agent_inspector' => $faker->name,

        'sell_reason' => $faker->sentence($nbWords = 10, $variableNbWords = true),
        'sell_note' => $faker->sentence($nbWords = 10, $variableNbWords = true),
        'other_agent' => $faker->name,

        'slug' => $faker->slug
    ];
});

$factory->define(App\PropertyLanguage::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence($nbWords = 3, $variableNbWords = true),
        'description' => $faker->sentence($nbWords = 10, $variableNbWords = true),
        'locale' => 'en'
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        'parent' => 0,
        'order' => 1,
    ];
});

$factory->define(App\CategoryLanguage::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->word,
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'locale' => 'en'
    ];
});
