<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public static function getSurname()
    {
        $matches = [];
        preg_match('/(foo)(bar)(baz)/', 'foobarbaz', $matches, PREG_OFFSET_CAPTURE);
    }


    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function teamUser(){
        return $this->hasMany(TeamUser::class);
    }

    public function teams()
    {
        /*
        $participant = Auth::user()->participant()->first();
        $teams = $participant->teams;
        return $teams;
        */
        return $this->belongsToMany(Team::class, 'team_users')->withPivot('isCaptain');


        //return $this->hasManyThrough('App\Models\Team', 'App\Participant', 'team_id','user_id' );
    }

    // Returns whether the user is locally authenticated or remotely (SAML)
    public function isLocal()
    {
        return !empty($this->password);
    }

    public function isUnsigned($id)
    {
        $participant = parent::where('id', $id)->first();
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
