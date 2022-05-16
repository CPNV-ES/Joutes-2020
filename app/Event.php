<?php

namespace App;

use App\Enums\EventState;
use Illuminate\Database\Eloquent\Model;

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
