<?php

use Illuminate\Database\Seeder;

class PageLocalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\PageLocale::create([
            'page_id' => 1,
            'meta_keyword' => 'your keyword',
            'meta_description' => 'your description',
            'title' => 'home',
            'content' => 'home',
            'slug' => 'home',
            'locale' => 'en'
        ]);

        \App\PageLocale::create([
            'page_id' => 2,
            'meta_keyword' => 'your keyword',
            'meta_description' => 'your description',
            'title' => 'about',
            'content' => 'about',
            'slug' => 'about',
            'locale' => 'en'
        ]);

        \App\PageLocale::create([
            'page_id' => 3,
            'meta_keyword' => 'your keyword',
            'meta_description' => 'your description',
            'title' => 'contact',
            'content' => 'contact',
            'slug' => 'contact',
            'locale' => 'en'
        ]);
    }
}
