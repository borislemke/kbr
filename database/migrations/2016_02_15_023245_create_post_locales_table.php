<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostLocalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_locales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id');
            $table->string('meta_keyword')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('title');
            $table->text('content')->nullable();
            $table->string('locale');
            $table->string('slug');
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
        Schema::drop('post_locales');
    }
}
