<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGallerysTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('galleries', function ($table){
            $table->increments('id');
            $table->smallInteger('post_id');
            $table->string('slug');
            $table->string('name');
            $table->string('title');
            $table->string('small_image');
            $table->text('text');
            $table->string('image');
            $table->smallInteger('parent');
            $table->string('tags');
            $table->smallInteger('status');
            $table->string('alt');
            $table->smallInteger('sorted');
            $table->boolean('noindex');
            $table->string('description');
            $table->string('keywords');
            $table->softDeletes();
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
		Schema::drop('galleries');//
	}

}
