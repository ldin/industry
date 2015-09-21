<?php

class ItemTableSeeder extends Seeder {

  public function run()
  {
    // DB::table('products')->delete();
    DB::table('products')->insert(array(
      array( 'slug' => 'item-2', 'name'=>'Товар-2', 'title'=>'Title', 'post_id'=>3, 'status'=>1),
      array( 'slug' => 'item-3', 'name'=>'Товар-3', 'title'=>'Title', 'post_id'=>3, 'status'=>1),
      array( 'slug' => 'item-4', 'name'=>'Товар-4', 'title'=>'Title', 'post_id'=>3, 'status'=>1),
      array( 'slug' => 'item-5', 'name'=>'Товар-5', 'title'=>'Title', 'post_id'=>3, 'status'=>1),
      array( 'slug' => 'item-6', 'name'=>'Товар-6', 'title'=>'Title', 'post_id'=>3, 'status'=>1),
      array( 'slug' => 'item-7', 'name'=>'Товар-7', 'title'=>'Title', 'post_id'=>3, 'status'=>1),
      array( 'slug' => 'item-8', 'name'=>'Товар-8', 'title'=>'Title', 'post_id'=>3, 'status'=>1),
      array( 'slug' => 'item-9', 'name'=>'Товар-9', 'title'=>'Title', 'post_id'=>3, 'status'=>1),
      array( 'slug' => 'item-10', 'name'=>'Товар-10', 'title'=>'Title', 'post_id'=>3, 'status'=>1),
      array( 'slug' => 'item-11', 'name'=>'Товар-11', 'title'=>'Title', 'post_id'=>3, 'status'=>1),
      array( 'slug' => 'item-12', 'name'=>'Товар-12', 'title'=>'Title', 'post_id'=>3, 'status'=>1),
      array( 'slug' => 'item-13', 'name'=>'Товар-13', 'title'=>'Title', 'post_id'=>3, 'status'=>1),
      array( 'slug' => 'item-14', 'name'=>'Товар-14', 'title'=>'Title', 'post_id'=>3, 'status'=>1),
      array( 'slug' => 'item-15', 'name'=>'Товар-15', 'title'=>'Title', 'post_id'=>3, 'status'=>1),
      array( 'slug' => 'item-16', 'name'=>'Товар-16', 'title'=>'Title', 'post_id'=>3, 'status'=>1),
      array( 'slug' => 'item-17', 'name'=>'Товар-17', 'title'=>'Title', 'post_id'=>3, 'status'=>1),
      array( 'slug' => 'item-18', 'name'=>'Товар-18', 'title'=>'Title', 'post_id'=>3, 'status'=>1),

    ));

  }

}

//заполнить базу:
//php artisan db:seed --class=ItemTableSeeder
