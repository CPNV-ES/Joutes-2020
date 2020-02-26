<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pool extends Model
{
    public $timestamps = false;

    public function contenders()
    {
        return $this->hasMany(Contender::class);
    }

    public function games(){
        return $this->hasManyThrough(Game::class, Contender::class, 'pool_id', 'contender1_id');
    }



}
