<?php

use Illuminate\Database\Seeder;

class TermsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Term::create([
            'name' => 'villa',
            'slug' => 'villa',
            'route' => 'villa',
            'type' => 'property_category',
            'order' => 0,
            'parent_id' => 0
        ]);

        \App\Term::create([
            'name' => 'villa rental',
            'slug' => 'villa-rental',
            'route' => 'villa_rental',
            'type' => 'property_category',
            'order' => 0,
            'parent_id' => 0
        ]);

        \App\Term::create([
            'name' => 'land',
            'slug' => 'land',
            'route' => 'land',
            'type' => 'property_category',
            'order' => 1,
            'parent_id' => 0
        ]);

        \App\Term::create([
            'name' => 'beachfront property',
            'slug' => 'beachfront-property',
            'route' => 'beachfront_property',
            'type' => 'property_tag',
            'order' => 0,
            'parent_id' => 0
        ]);

        \App\Term::create([
            'name' => 'home and retirement',
            'slug' => 'home-and-retirement',
            'route' => 'home_and_retirement',
            'type' => 'property_tag',
            'order' => 0,
            'parent_id' => 0
        ]);
    }
}
