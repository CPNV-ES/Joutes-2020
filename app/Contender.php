<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contender extends Model
{
    public $timestamps = false;

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function fromPool(){
        return $this->belongsTo('App\Pool', 'pool_from_id');
    }

    public function pool() {
        return $this->belongsTo(Pool::class, 'pool_id');
    }

}
