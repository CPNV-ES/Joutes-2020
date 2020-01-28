<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contender extends Model
{
    public $timestamps = false;

    public function teams()
    {
        return $this->belongsToMany('App\Team');
    }
}
