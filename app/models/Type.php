<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Type extends Eloquent
{

	public function page()
	{
	    return $this->hasMany('Post');
	}

    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
    protected $softDelete = true;
}
