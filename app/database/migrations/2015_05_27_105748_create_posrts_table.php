<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosrtsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('posts', function ($table){
            $table->increments('id');
            $table->smallInteger('type_id');
            $table->string('slug');
            $table->string('name');
            $table->string('title');
            $table->text('preview');
            $table->text('text');
            $table->string('image');
            $table->smallInteger('parent');
            $table->string('tags');
            $table->smallInteger('status');
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
		Schema::drop('posts');//
	}

}
