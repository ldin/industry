<?php

class AttributeTableSeeder extends Seeder {

  public function run()
  {
    DB::table('attributes')->delete();

    DB::table('attributes')->insert(array(
      array( 'name' => 'model', 'value' => 'модель', 'group' => 'attribute', 'required'=>1,),
      array( 'name' => 'lenght', 'value' => 'длина', 'group' => 'size', 'required'=>1,),
      array( 'name' => 'width', 'value' => 'ширина','group' => 'size', 'required'=>1,),
      array( 'name' => 'height', 'value' => 'высота', 'group' => 'size', 'required'=>1,),
      array( 'name' => 'weight', 'value' => 'вес', 'group' => 'size', 'required'=>1,),
      // array( 'name' => '', 'value' => '', 'required'=>1,),
    ));
  }

}


//заполнить базу:
//php artisan db:seed --class=AttributeTableSeeder
