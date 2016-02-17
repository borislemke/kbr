<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvincesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provinces', function (Blueprint $table) {

            $table->increments('id');
            $table->string('province_name', 50);
            $table->string('province_name_abbr', 50);
            $table->string('province_name_id', 50);
            $table->string('province_name_en', 50);
            $table->smallInteger('province_capital_city_id')->unsigned()->index();
            $table->string('iso_code', 5)->index();
            $table->string('iso_name', 50);
            $table->enum('iso_type',
            [
                'province',
                'autonomous province',
                'special district',
                'special region'
            ]);
            $table->string('iso_geounit', 2)->index();
            $table->string('country_iso', 5);
            $table->tinyInteger('timezone');
            $table->float('province_lat', 10, 6)->nullable()->index();
            $table->float('province_lon', 10, 6)->nullable()->index();

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
        Schema::drop('provinces');
    }
}
