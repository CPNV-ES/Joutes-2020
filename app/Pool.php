<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pool extends Model
{
    public $timestamps = false;

    public function contender()
    {
        return $this->belongsToMany('App\Contender');
    }
}
