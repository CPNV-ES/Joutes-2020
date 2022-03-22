<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Types\False_;

class User extends Authenticatable
{
    use SoftDeletes;

    protected $fillable = ['username', 'first_name', 'last_name', 'password', 'role'];
    public $timestamps = false;
    protected $hidden = ['password', 'remember_token'];
    /**
     * @var mixed
     */

    public static function getSurname()
    {
        $matches = [];
        preg_match('/(foo)(bar)(baz)/', 'foobarbaz', $matches, PREG_OFFSET_CAPTURE);
    }


    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function teams()
    {
        /*
        $participant = Auth::user()->participant()->first();
        $teams = $participant->teams;
        return $teams;
        */
        return $this->belongsToMany('App\Team', 'team_user')->withPivot('isCaptain');


        //return $this->hasManyThrough('App\Team', 'App\Participant', 'team_id','user_id' );
    }

    // Returns whether the user is locally authenticated or remotely (SAML)
    public function isLocal()
    {
        return !empty($this->password);
    }

    public function isUnsigned($id)
    {
        $participant = user::where('id', $id)->first();
        return (count($participant->teams) < 2);
    }

    public function playedIn()
    {
        $dates = [];
        foreach ($this->teams as $team) {
            array_push($dates, $team->tournament->end_date->format('Y'));
        }
        return array_unique($dates); //Distinct on the array to prevent from dates in duplicata
    }

    public function isDeletable()
    {
        foreach ($this->teams as $team) {
            $team->tournament->event->eventState > 1 ? $isDeletable = False : $isDeletable = True;
            if (!$isDeletable) return False;
        }
        return True;
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_role_user');
    }
}
