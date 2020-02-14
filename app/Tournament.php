<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    public $timestamps = false;
    protected $dates = ['start_date', 'end_date']; //need to user convert format date

    /**
     * MODEL PROPERTY
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'start_date', 'end_date', 'event_id', 'sport_id', 'end_date', 'max_teams'
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


    /**
     * Create a new belongs to many relationship instance between Tournament and Team
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     *
     */
    public function teams()
    {
        return $this->hasMany('App\Team');
    }

    public function completeTeams()
    {
        return $this->teams()->with('users');
    }


    public function results() {
        $pools = $this->pools;
        $filtered = null;
        if (!empty($pools->last())) {
            $final_stage = $pools->last()->stage;
            $filtered = $pools->filter(function($value, $key) use (&$final_stage) {
                if ($value['stage'] == $final_stage && $value['isFinished'] == 1)
                return $value;
            });
            $pools = null;
        }
        return $filtered;
    }



    public function getPoolsByTournamentId($tournament){
        $pools = $tournament->pools;
        return $pools;
    }



}
