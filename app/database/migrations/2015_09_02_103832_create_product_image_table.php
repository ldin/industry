<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductImageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('product_image', function($table) {
            $table->increments('id');
            $table->smallInteger('product_id');
            $table->string('image');
            $table->string('small_image');
            $table->string('alt');
            $table->text('text');
            $table->smallInteger('status');
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
		Schema::drop('product_image');
	}

}
