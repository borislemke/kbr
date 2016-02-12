<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            // $table->string('email')->unique();
            $table->string('email');
            $table->string('password', 60);
            $table->integer('role_id');
            $table->integer('position_id');
            $table->integer('branch_id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('address');
            $table->string('phone');
            $table->string('city');
            $table->string('province');
            $table->string('country');
            $table->integer('zipcode');
            $table->string('image');
            $table->boolean('active');

            $table->integer('author_id');

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::drop('Users');
    }
}
