<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Team extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'isCaptain', 'owner_id', 'validation', 'completion'];

    public function participants()
    {
        return $this->belongsToMany(User::class, 'team_users')->withPivot('isCaptain');
    }

    public function teamUser()
    {
        return $this->hasMany(TeamUser::class);
    }

    //Get team tournament
    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }

    //
    public function sport()
    {
        return $this->tournament->sport();
    }

    public function games_contender_1()
    {
        return $this->hasManyThrough(Game::class, Contender::class, 'team_id', 'contender1_id');
    }

    public function games_contender_2()
    {
        return $this->hasManyThrough(Game::class, Contender::class, 'team_id', 'contender2_id');
    }

    public function games()
    {
        $collection = $this->games_contender_1->merge($this->games_contender_2);
        return $collection->sortBy('start_time');
    }


    // Verify if the teams have all participants required to be full
    public function isValid()
    {
        return ($this->validation == 1);
    }

    public function isComplete()
    {
        if ($this->participants()->count() >= $this->sport->max_participant || $this->completion) return true;
        else return false;
    }

    public function captain()
    {
        $captain = $this->participants()->firstwhere('isCaptain', 1);
        return $captain !== null && Auth::check() ? $captain->getOriginal()['id'] == Auth::id() : false;
    }

    public function pools()
    {
        return $this->belongsToMany(Pool::class, 'Contenders');
    }

    public function setFlag($flagName, $value)
    {
        if (in_array($flagName, ['validation', 'completion'])) {
            $this->$flagName = $value;
        }
    }

    public static function newTeam($tournament, $data)
    {
        $team = new Team();
        $team->fill($data);
        $team->tournament()->associate($tournament);
        $team->save();

        $teamUser = new TeamUser;
        $teamUser->user_id = Auth::id();
        $teamUser->team_id = $team->id;
        $teamUser->isCaptain = 1;
        $teamUser->save();
    }

}
