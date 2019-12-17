<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    public $timestamps = false;

    /**
     * Create a new belongs to relationship instance between Tournament and Event
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Create a new belongs to relationship instance between Tournament and Sport
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     *
     */
    public function sport()
    {
        return $this->belongsTo('App\Sport');
    }

}
