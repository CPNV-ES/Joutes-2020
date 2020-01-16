<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    public $timestamps = false;
    protected $fillable = array('name', 'start_date', 'end_date', 'start_time', 'event_id','max_teams'); // -> We have to define all data we use on our sport table (For use ->all())
    protected $dates = ['start_date', 'end_date']; //need to user convert format date

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


    /**
     * Create a new belongs to many relationship instance between Tournament and Pool
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     *
     */
    public function pools()
    {
        return $this->hasMany('App\Pool');
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




    //Get specific pool
    public function pool($id)
    {
        // get tournament pools
        $pools = $this->pools;

        // look for wanted pool
        foreach ($pools as $pool) {
            if ($pool->id == $id) {
                return $pool;
            }
        }
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






}
