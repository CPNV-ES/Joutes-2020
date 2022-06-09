<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tournament extends Model
{
    public $timestamps = false;
    protected $dates = ['start_date', 'end_date']; //need to user convert format date

    /**
     * MODEL PROPERTY
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'start_date', 'end_date', 'event_id', 'sport_id', 'end_date', 'max_teams'
    ];

    public function getStages()
    {
      return $this->pools()->distinct('stage')->orderBy('stage')->pluck('stage')->toArray();
    }

    public function getPoolsOfStage($tournamentId, $stageNumber)
    {
        return Pool::where('stage', '=', $stageNumber)->where('tournament_id', '=', $tournamentId)->get();
    }

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
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     *
     */
    public function sport()
    {
        return $this->belongsTo(Sport::class);
    }

    public function pools()
    {
        return $this->hasMany(Pool::class);
    }


    /**
     * Create a new belongs to many relationship instance between Tournament and Team
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     */
    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    public function completeTeams()
    {
        return $this->teams()->with('users');
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

    public function getTeamsNotInAPool()
    {
        $teamsNotInAPool = DB::table('contenders')
            ->rightJoin('teams', 'teams.id', '=', 'contenders.team_id')
            ->whereNull('contenders.team_id')
            ->where('tournament_id', '=', $this->id)
            ->get();

        return $teamsNotInAPool;
    }
    public function getTeamForPool(string $name)
    {
        $team = DB::table('contenders')
            ->rightJoin('teams', 'teams.id', '=', 'contenders.team_id')
            ->where('tournament_id', '=', $this->id)
            ->where('teams.name', '=', $name)
            ->get();
        ;


        return $team->concat($this->getTeamsNotInAPool());
    }


    public static function isNewTeam(string $name, Tournament $tournament)
    {
        return self::whereHas('teams',function ($q) use ($tournament, $name) {
                $q->where('name',$name)->where('tournament_id',$tournament['id']);
            })->count() === 0;

    }
}
