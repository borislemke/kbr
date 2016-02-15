<?php

use Illuminate\Database\Seeder;

class LocalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Locale::create([
            'name' => 'english',
            'code' => 'en',
            'icon' => 'en.png'
        ]);

        \App\Locale::create([
            'name' => 'bahasa',
            'code' => 'id',
            'icon' => 'id.png'
        ]);

        \App\Locale::create([
            'name' => 'french',
            'code' => 'fr',
            'icon' => 'fr.png'
        ]);

        \App\Locale::create([
            'name' => 'rusian',
            'code' => 'ru',
            'icon' => 'ru.png'
        ]);

    }
}
