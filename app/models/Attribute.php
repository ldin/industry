<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Attribute extends Eloquent
{

    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
    protected $softDelete = true;
}