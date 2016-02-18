<?php

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Page::create([
            'user_id' => 1,
            'slug' => 'home',
            'route' => 'home',
            'status' => 1
        ]);

        \App\Page::create([
            'user_id' => 1,
            'slug' => 'about',
            'route' => 'about',
            'status' => 1
        ]);

        \App\Page::create([
            'user_id' => 1,
            'slug' => 'contact',
            'route' => 'contact',
            'status' => 1
        ]);
        
    }
}
