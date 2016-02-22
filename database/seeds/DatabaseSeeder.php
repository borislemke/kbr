<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Model::unguard();

        $this->call(RolesTableSeeder::class);
        $this->call(BranchesTableSeeder::class);

        $this->call(CountriesTableSeeder::class);
        $this->call(ProvincesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);

        $this->call(LocalesTableSeeder::class);

        $this->call(UsersTableSeeder::class);

        $this->call(TermsTableSeeder::class);

        $this->call(PagesTableSeeder::class);

        $this->call(PageLocalesTableSeeder::class);

        factory(App\Contact::class, 100)->create();

        factory(App\User::class, 100)->create()->each(function ($u) {

            factory(App\Property::class, 10)->create(['user_id' => $u->id])->each(function($p) {

                Model::unguard();

                $p->propertyLocales()->save(factory(App\PropertyLocale::class)->make());

                $p->propertyMetas()->saveMany([

                    // document
                    new \App\PropertyMeta(['name' => 'agent agreement', 'value' => 'ready', 'type' => 'document', 'status' => 1]),
                    new \App\PropertyMeta(['name' => 'pondok wisata license', 'value' => 'ready', 'type' => 'document', 'status' => 1]),
                    new \App\PropertyMeta(['name' => 'tax construction', 'value' => 'ready', 'type' => 'document', 'status' => 1]),
                    new \App\PropertyMeta(['name' => 'photographs', 'value' => 'ready', 'type' => 'document', 'status' => 1]),
                    new \App\PropertyMeta(['name' => 'imb', 'value' => 'ready', 'type' => 'document', 'status' => 1]),
                    new \App\PropertyMeta(['name' => 'land certificate', 'value' => 'ready', 'type' => 'document', 'status' => 1]),
                    new \App\PropertyMeta(['name' => 'notary details', 'value' => 'ready', 'type' => 'document', 'status' => 1]),
                    new \App\PropertyMeta(['name' => 'owner idcard', 'value' => 'ready', 'type' => 'document', 'status' => 1]),

                    // facilities
                    new \App\PropertyMeta(['name' => 'bedroom', 'value' => '2 room', 'type' => 'facility', 'status' => 1]),
                    new \App\PropertyMeta(['name' => 'bathroom', 'value' => '1 room', 'type' => 'facility', 'status' => 1]),
                    new \App\PropertyMeta(['name' => 'sale in furnish', 'value' => 'include furnish', 'type' => 'facility', 'status' => 1]),

                    // distance                    
                    new \App\PropertyMeta(['name' => 'beach', 'value' => '1 hour', 'type' => 'distance', 'status' => 1]),
                    new \App\PropertyMeta(['name' => 'airport', 'value' => '2 minutes', 'type' => 'distance', 'status' => 1]),
                    new \App\PropertyMeta(['name' => 'market', 'value' => '3 kilometres', 'type' => 'distance', 'status' => 1])
                ]);

                $p->propertyTerms()->save(factory(App\PropertyTerm::class)->make());

                Model::reguard();

            });

            factory(App\Post::class, 10)->create(['user_id' => $u->id])->each(function($p) {

                $p->postLocales()->save(factory(App\PostLocale::class)->make());

                Model::unguard();
                $p->postTerms()->save(
                    new \App\PostTerm(['term_id' => 6])
                );
                Model::reguard();

            });

        });

        factory(App\Customer::class, 100)->create()->each(function ($c) {

            $c->enquiries()->save(factory(App\Enquiry::class)->make());

            $c->testimonials()->save(factory(App\Testimony::class)->make());

        });

        Model::reguard();
    }
}
