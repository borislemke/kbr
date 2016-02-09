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
        $this->call(CategoriesTableSeeder::class);

        $this->call(CountriesTableSeeder::class);
        $this->call(ProvincesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);

        $this->call(LanguagesTableSeeder::class);

        $this->call(UsersTableSeeder::class);

        factory(App\User::class, 100)->create()->each(function ($u) {

            factory(App\Property::class, 10)->create(['user_id' => $u->id])->each(function($p) {

                $p->propertyLanguages()->save(factory(App\PropertyLanguage::class)->make());

                Model::unguard();

                $p->documents()->saveMany([
                    new \App\Document(['name' => 'Agent Agreement', 'description' => 'ready']),
                    new \App\Document(['name' => 'Pondok Wisata Lcs', 'description' => 'ready']),
                    new \App\Document(['name' => 'Tax Construction', 'description' => 'ready']),
                    new \App\Document(['name' => 'Photographs', 'description' => 'ready']),
                    new \App\Document(['name' => 'IMB', 'description' => 'ready']),
                    new \App\Document(['name' => 'Land Certf.', 'description' => 'ready']),
                    new \App\Document(['name' => 'Notary Details', 'description' => 'ready']),
                    new \App\Document(['name' => 'Owner KTP', 'description' => 'ready'])
                ]);

                $p->facilities()->saveMany([
                    new \App\Facility(['name' => 'Bedroom', 'description' => '2 room']),
                    new \App\Facility(['name' => 'Bathroom', 'description' => '1 room']),
                    new \App\Facility(['name' => 'Sale in Furnish', 'description' => 'include furnish'])
                ]);

                $p->distances()->saveMany([
                    new \App\Distance(['from' => 'Beach', 'value' => 1, 'unit' => 'km']),
                    new \App\Distance(['from' => 'Airport', 'value' => 2, 'unit' => 'minutes']),
                    new \App\Distance(['from' => 'Market', 'value' => 3, 'unit' => 'hours'])
                ]);

                Model::reguard();

            });

        });

        factory(App\Customer::class, 100)->create()->each(function ($c) {

            $c->inquiries()->save(factory(App\Inquiry::class)->make());

            $c->testimonials()->save(factory(App\Testimony::class)->make());

        });

        Model::reguard();
    }
}
