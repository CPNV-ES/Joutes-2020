<?php

namespace App;

use App\Enums\EventState;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function allTournamentsRelatedToAUser(User $user)
    {
        return DB::table('teams')
            ->join('tournaments', 'tournaments.id', '=', 'teams.tournament_id')
            ->join('events', 'events.id', '=', 'tournaments.event_id')
            ->join('team_users', 'team_users.team_id', '=', 'teams.id')
            ->select('teams.id as teams_id', 'teams.name as teams_name', 'teams.name', 'tournaments.id', 'tournaments.name', 'tournaments.start_date', 'tournaments.end_date', 'tournaments.event_id', 'tournaments.sport_id', 'tournaments.end_date')
            ->where('team_users.user_id', '=', $user->id)
            ->where('events.id', '=', $this->id)
            ->get();
    }
}
