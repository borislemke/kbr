<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Role::create([
            'name' => 'super admin'
        ]);

        \App\Role::create([
            'name' => 'manager'
        ]);

        \App\Role::create([
            'name' => 'super agent'
        ]);

        \App\Role::create([
            'name' => 'agent'
        ]);
    }
    
}
