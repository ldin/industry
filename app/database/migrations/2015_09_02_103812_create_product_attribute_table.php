<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductAttributeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('product_attribute', function($table) {
            $table->increments('id');
            $table->smallInteger('attribute_id');
            $table->smallInteger('product_id');
            $table->text('value');
            $table->smallInteger('sort');
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
		Schema::drop('product_attribute');
	}

}
