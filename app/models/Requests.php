<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Requests extends Eloquent
{

    protected $table = 'requests';

    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
    protected $softDelete = true;
}
