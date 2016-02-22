<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('properties', function (Blueprint $table) {
            // index
            $table->increments('id');
            $table->integer('user_id')->default(0);
            $table->integer('customer_id')->default(0);
            // $table->integer('category_id')->default(0);

            $table->enum('currency', array('IDR', 'USD', 'EUR'));
            $table->double('price')->default(0);
            $table->enum('price_label', ['none', 'daily', 'weekly', 'monthly', 'annually'])->default('none');
            $table->double('discount')->default(0);
            $table->enum('type', array('free hold', 'lease hold'));

            // size
            $table->double('building_size')->default(0);
            $table->double('land_size')->default(0); 
            $table->integer('bedroom')->default(0)->nullable();
            $table->integer('bathroom')->default(0)->nullable();
            $table->integer('bed')->default(0)->nullable();

            $table->boolean('sold')->default(0);
            $table->string('code')->nullable();
            $table->enum('status', array(1, 0, -1, -2))->default(-1);
            $table->string('year')->nullable();

            $table->double('map_latitude')->nullable();
            $table->double('map_longitude')->nullable();

            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('country')->nullable();

            $table->integer('view')->default(0);

            $table->string('view_north')->nullable();
            $table->string('view_east')->nullable();
            $table->string('view_west')->nullable();
            $table->string('view_south')->nullable();

            $table->boolean('is_price_request')->default(0)->nullable();
            $table->boolean('is_exclusive')->default(0)->nullable();

            $table->string('owner_name')->nullable();
            $table->string('owner_email')->nullable();
            $table->string('owner_phone')->nullable();

            $table->string('agent_commission')->nullable();
            $table->string('agent_contact')->nullable();
            $table->string('agent_meet_date')->nullable();
            $table->string('agent_inspector')->nullable();

            $table->string('sell_reason')->nullable();
            $table->string('sell_note')->nullable();
            $table->string('other_agent')->nullable();

            $table->boolean('display')->default(0);
            $table->string('orientation')->nullable();
            $table->string('sell_in_furnish')->nullable();

            $table->double('lease_period')->default(0);
            $table->string('lease_year')->nullable();

            $table->timeStamps();
            $table->softDeletes();
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
        Schema::drop('properties');
    }
}
