<?php

namespace App\Models;

use App\Enums\EventState;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\IntranetConnection;

class Event extends Model
{
    public $timestamps = false;
    public $percentageParticipation = 0;
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
    //Get event tournaments if poolsReady return is not null
    public function tournamentsReady()
    {
        $tournaments = $this->tournaments()->get();
        $tournamentsReady = array();
        foreach ($tournaments as $tournament) {
            //if tournament  pools ins't empty
            if ($tournament->poolsReady()->toArray()) {
                $tournamentsReady[] = $tournament;
            }
        }
        return $tournamentsReady;
    }

    /**
     * Get all users related to this event
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'event_role_user');
    }

    public function isRegisterOrReady()
    {
        return ($this->eventState == EventState::Register || $this->eventState == EventState::Ready);
    }

    public function isPrepOrRegistered()
    {
        return ($this->eventState == EventState::Prep || $this->eventState == EventState::Register);
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
    /**
     * Get percentage of participation related to this event from specific roles
     *
     * @return float
     */
    public function percentageParticipation()
    {
        $expectedPartipant = $this->getExpectedParticipants();
        $actualParticipant = $this->users()
            ->where('users.role_id', Role::findBySlug('PART')->id)
            ->orWhere('users.role_id', Role::findBySlug('GEST')->id)
            ->get()->unique();
        return round((count($actualParticipant) / count($expectedPartipant)) * 100);
    }

    public function getExpectedParticipants()
    {
        $students_array = User::all();
        $schoolClass = SchoolClass::all();

        $studentsIntranet = [];
        foreach ($students_array as $student) {
            if ($schoolClass->contains('id', $student->attributes['class_id'])) {
                $studentsIntranet[$student->id] = [
                    'firstname' => $student->first_name,
                    'lastname' =>  strtolower($student->last_name),
                ];
            }
        }
        return $studentsIntranet;
    }
}
