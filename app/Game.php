<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public $timestamps = false;
    protected $fillable = array('score_contender1', 'score_contender2', 'date', 'start_time', 'contender1_id', 'contender2_id', 'court_id');

    public function contender1() {
        return $this->belongsTo('App\Contender', 'contender1_id');
    }

    public function contender2() {
        return $this->belongsTo('App\Contender', 'contender2_id');
    }

    public function pool() {
        return $this->contender1->pool;
    }
}
