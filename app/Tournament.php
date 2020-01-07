<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    public $timestamps = false;

    /**
     * MODEL PROPERTY
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'start_date', 'img', 'event_id', 'sport_id', 'end_date', 'max_teams'
    ];

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
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     *
     */
    public function sport()
    {
        return $this->belongsTo(Sport::class);
    }

    public function pools()
    {
        return $this->hasMany(Pool::class);
    }

}
