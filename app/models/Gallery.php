<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Gallery extends Eloquent
{
    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
    protected $softDelete = true;
}
