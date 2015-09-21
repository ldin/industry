<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ProductAttribute extends Eloquent
{

	protected $table = 'product_attribute';

	public function product()
	  {
	    return $this->belongsTo('Product');
	  }

}