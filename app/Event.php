<?php

namespace App;

use App\Enums\EventState;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public $timestamps = false;

    //Get event tournaments
    public function tournaments()
    {
        return $this->hasMany(Tournament::class)->orderBy('sport_id'); // XCL: temporary fix on order, just to keep admin and injured fake tournaments at the end of the list
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
        return $this->belongsToMany(User::class, 'event_role_user');
    }

    public function isRegisterOrReady()
    {
        return ($this->eventState == EventState::Register || $this->eventState == EventState::Ready);
    }
}
