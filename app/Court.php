<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
    public $timestamps = false;

    /**
     * Create a new belongs to relationship instance between Court and Sport
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author Doran Kayoumi
     */
    public function sport(){
        return $this->belongsTo(Sport::class);
    }

}
