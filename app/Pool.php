<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pool extends Model
{
    public $timestamps = false;

    protected $fillable = [
      'start_time', 'end_time', 'poolName', 'stage', 'poolSize', 'tournament_id', 'mode_id', 'game_type_id'
  ];

    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }
}
