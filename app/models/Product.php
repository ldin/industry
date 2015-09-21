<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Product extends Eloquent
{

	public function productAttribute()
	  {
	    return $this->hasMany('ProductAttribute', 'product_id');
	  }

	public function productImage()
	  {
	    return $this->hasMany('ProductImage', 'product_id');
	  }

    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
    protected $softDelete = true;
}