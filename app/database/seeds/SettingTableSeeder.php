<?php

class SettingTableSeeder extends Seeder {

  public function run()
  {
    DB::table('settings')->delete();

    DB::table('settings')->insert(array(
      array( 'name' => 'phone', 'title'=>'phone', 'value'=>'', ),
      array( 'name' => 'email', 'title'=>'email', 'value'=>'', ),
      array( 'name' => 'title', 'title'=>'title', 'value'=>'Совет Консалтинг - oрганизация и сопровождение бизнеса в Tурции', ),
      array( 'name' => '', 'title'=>'', 'value'=>'', ),
      array( 'name' => '', 'title'=>'', 'value'=>'', ),
      array( 'name' => '', 'title'=>'', 'value'=>'', ),
    ));
  }

}


//заполнить базу:
//php artisan db:seed --class=SettingTableSeeder
