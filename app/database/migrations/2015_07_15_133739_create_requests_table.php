<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('requests', function($table) {
            $table->increments('id');
            $table->string('email');
            $table->string('name');
            $table->string('phone');
            $table->text('text');
            $table->smallInteger('status');
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
        Schema::drop('requests');		//
	}

}
