<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestimonialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('Testimonials', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id');
            $table->string('title');
            $table->text('content');
            $table->boolean('status')->default(0);
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
        Schema::drop('Testimonials');
    }
}
