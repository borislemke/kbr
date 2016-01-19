<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('Branches', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('city');
            $table->string('province');
            $table->string('country');
            $table->string('manager');
            $table->timeStamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('Branches');
    }
}
