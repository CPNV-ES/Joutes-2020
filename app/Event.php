<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class Event extends Model
{
    public $timestamps = false;

    //Get event tournaments
    public function tournaments()
    {
        return $this->hasMany('App\Tournament')->orderBy('sport_id'); // XCL: temporary fix on order, just to keep admin and injured fake tournaments at the end of the list
    }

    //Get specific tournament
    public function tournament($id)
    {

        // get event tournaments
        $tournaments = $this->tournaments()->get();

        // look for wanted tournament
        foreach ($tournaments as $tournament) {
            if ($tournament->id == $id) {
                return $tournament;
            }
        }
    }

    /**
     * Get all users related to this event
     *
     * @return void
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'event_engagement_user')->withPivot('engagement_id');
    }

    /**
     * Check if a specific user is related to this event
     *
     * @param User $user
     * @return void
     */
    public function user(User $user)
    {
        return $this->users()->firstWhere('user_id', $user->id);
    }
}
