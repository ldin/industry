<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('products', function ($table){
            $table->increments('id');
            $table->smallInteger('post_id');
            $table->string('slug');
            $table->string('name');
            $table->string('title');
            $table->text('description');
            $table->string('image');
            $table->string('country');
            $table->smallInteger('parent');
            $table->string('tags');
            $table->smallInteger('status');
            $table->boolean('noindex');
            $table->string('meta_description');
            $table->string('meta_keywords');
            $table->softDeletes();
            $table->timestamps();
        });		//
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('products');
	}

}
