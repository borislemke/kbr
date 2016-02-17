<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');

            $table->tinyInteger('province_id')->unsigned()->index();
            $table->string('city_name', 50)->index();
            $table->string('city_name_full', 100)->index();
            $table->enum('city_type', ['kabupaten', 'kota'])->nullable();
            $table->float('city_lat', 10, 6)->nullable()->index();
            $table->float('city_lon', 10, 6)->nullable()->index();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cities');
    }
}
