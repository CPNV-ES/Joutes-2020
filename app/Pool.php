<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pool extends Model
{
    public $timestamps = false;

    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }
}
