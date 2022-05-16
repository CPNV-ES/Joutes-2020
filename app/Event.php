<?php

namespace App;

use App\Enums\EventState;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
    /**
     * Get percentage of participation related to this event from specific roles
     *
     * @return void
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

        $url = "https://intranet.cpnv.ch/sainte-croix/etudiants.json?alter[include]=current_class&api_key=demo&signature=49be40b0e7383ccd637804ad1faacfdf";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);

        $students_array = json_decode($resp);
        $schoolClass = SchoolClass::all();

        $studentsIntranet = [];
        foreach ($students_array as $student) {
            if ($schoolClass->contains('name', $student->current_class->name)) {
                $studentsIntranet[$student->id] = [
                    'firstname' => $student->firstname,
                    //lowercase except first letter

                    'lastname' =>  ucfirst(strtolower($student->lastname)),
                    'class' => $student->current_class->name,
                ];
            }
        }
        return $studentsIntranet;
    }
}
