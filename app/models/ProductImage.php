<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ProductImage extends Eloquent
{

	protected $table = 'product_image';

	public function product()
	  {
	    return $this->belongsTo('Product');
	  }

}