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
        'role_id' => $faker->randomElement([1, 2, 3, 4]),
        'position_id' => 1,
        'branch_id' => 1,
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'city' => 'denpasar',
        'province' => 'bali',
        'country' => 'indonesia',
        'zipcode' => $faker->postcode,
        'image' => 'user.jpg',
        'active' => 1
    ];
});

$factory->define(App\Testimony::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence($nbWords = 3, $variableNbWords = true),
        'content' => $faker->sentence($nbWords = 10, $variableNbWords = true),
        'status' => $faker->randomElement([0, 1])
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
        'city' => 'denpasar',
        'province' => 'bali',
        'country' => 'indonesia',
        'zipcode' => $faker->postcode,
        'image_profile' => 'customer.jpg',
        'newsletter' => 1,
        'active' => 1
    ];
});

$factory->define(App\Enquiry::class, function (Faker\Generator $faker) {
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

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
        'slug' => $slug = str_slug($faker->sentence($nbWords = 6, $variableNbWords = true)),
        'route' => str_replace('-', '_', $slug),
        'status' => 1
    ];
});

$factory->define(App\PostLocale::class, function (Faker\Generator $faker) {
    return [
        'meta_keyword' => 'your keyword',
        'meta_description' => 'your description',
        'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'content' => '<p>' . $faker->paragraph($nbSentences = 70, $variableNbSentences = true) . '</p>',
        'slug' => $slug = str_slug($faker->sentence($nbWords = 6, $variableNbWords = true)),
        'locale' => 'en'
    ];
});

$factory->define(App\Property::class, function (Faker\Generator $faker) {
    return [
        'currency' => $faker->randomElement($array = array ('IDR', 'USD', 'EUR')),
        'price' => $faker->randomNumber(7),
        'price_label' => $faker->randomElement($array = array ('none', 'daily', 'weekly', 'monthly', 'annually')),
        'discount' => $faker->randomNumber(2),
        'type' => $faker->randomElement($array = array ('free hold', 'lease hold')),

        'building_size' => $faker->randomNumber(2),
        'land_size' => $faker->randomNumber(3),
        'bedroom' => $faker->randomNumber(1),
        'bathroom' => $faker->randomNumber(1),
        'bed' => $faker->randomNumber(1),

        'sold' => $faker->randomElement([0, 1]),
        'status' => $faker->randomElement([-2, -1, 0, 1]),
        'year' => $faker->year($max = 'now'),
        'view' => $faker->randomDigit,

        'code' => 'VL' . $faker->randomNumber(4),

        'map_latitude' => (rand(8082268, 8842932) / 1000000) * -1,
        'map_longitude' => rand(114443923, 115689498) / 1000000,
        
        'city' => 'denpasar',
        'province' => 'bali',
        'country' => 'indonesia',

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
        'sell_in_furnish' => 'include furnish'
        
    ];
});

$factory->define(App\PropertyLocale::class, function (Faker\Generator $faker) {
    return [
        'meta_keyword' => 'your keyword',
        'meta_description' => 'your description',
        'title' => $faker->sentence($nbWords = 3, $variableNbWords = true),
        'content' => '<p>'. $faker->sentence($nbWords = 20, $variableNbWords = true) .'</p>',
        'slug' => $slug = str_slug($faker->sentence($nbWords = 6, $variableNbWords = true)),
        'locale' => 'en'
    ];
});

$factory->define(App\PropertyTerm::class, function (Faker\Generator $faker) {

    return [
        'term_id' => $faker->randomElement([1, 2, 3])
    ];
});

$factory->define(App\Contact::class, function (Faker\Generator $faker) {
    return [
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'email' => $faker->email,
        'message' => $faker->sentence($nbWords = 3, $variableNbWords = true)
    ];
});

