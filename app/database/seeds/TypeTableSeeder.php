<?php

class TypeTableSeeder extends Seeder {

  public function run()
  {
    DB::table('types')->delete();
    DB::table('types')->insert(array(
      array( 'type' => 'page', 'name'=>'Страница', 'status'=>'0', ),
      array( 'type' => 'about', 'name'=>'О компании', 'status'=>'1', ),
      array( 'type' => 'uslugi', 'name'=>'Услуги', 'status'=>'1', ),
      array( 'type' => 'ivest', 'name'=>'Инвестиции', 'status'=>'1', ),
      array( 'type' => 'partners', 'name'=>'Партнеры', 'status'=>'1', ),
      array( 'type' => 'news', 'name'=>'Новости', 'status'=>'1', ),
      array( 'type' => 'contacts', 'name'=>'Контакты', 'status'=>'1', ),      
    ));

  }

}

//заполнить базу:
//php artisan db:seed --class=TypeTableSeeder

