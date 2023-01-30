<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'sport_id', 'name', 'acronym'
    ];

    /**
     * Create a new belongs to relationship instance between Court and Sport
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     */
    public function sport()
    {
        return $this->belongsTo(Sport::class);
    }

}
