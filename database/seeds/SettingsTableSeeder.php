<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Setting::create([
            'name' => 'title',
            'value' => 'Kibarer'
        ]);

        \App\Setting::create([
            'name' => 'description',
            'value' => 'Property Agency'
        ]);

        \App\Setting::create([
            'name' => 'keyword',
            'value' => 'kibarer, property agency, villa for sale, villa for rent, lands for sale, lands for rent'
        ]);

    }
}
