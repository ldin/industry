<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Post extends Eloquent
{

	public function type()
	  {
	    return $this->belongsTo('Type');
	  }

    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
    protected $softDelete = true;
}
