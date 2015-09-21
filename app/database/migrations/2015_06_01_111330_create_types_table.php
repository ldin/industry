<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypesTable extends Migration {

	public function up()
	{
        Schema::create('types', function ($table){
            $table->increments('id');
            $table->string('type');
            $table->string('name');
            $table->string('template');
            $table->string('title');
            $table->text('text');
            $table->smallInteger('status');
            $table->smallInteger('position');
            $table->softDeletes();
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('types');
	}

}
