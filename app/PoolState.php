<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PoolState extends Model
{
    public $timestamps = false;

    protected $fillable = ['slug', 'name'];

}
