<?php

namespace App\Models;

use App\Enums\PoolState;
use App\Services\RoundRobinService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class Pool extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'start_time', 'end_time', 'poolName', 'stage', 'poolState', 'poolSize', 'tournament_id', 'mode_id', 'game_type_id'
    ];
    //TODO manage poolState with database slugs
    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }
    public function contenders()
    {
        return $this->hasMany(Contender::class);
    }

    public function mode()
    {
        return $this->belongsTo(PoolMode::class);
    }

    public function game_type()
    {
        return $this->belongsTo(GameType::class);
    }

    public function games()
    {
        return $this->hasManyThrough(Game::class, Contender::class, 'pool_id', 'contender1_id');
    }
    public function gamesWithoutScores()
    {
        return $this->games()->where('score_contender1', null)->where('score_contender2', null)->orderBy('start_time');
    }
    //get games if game as scores
    public function gamesWithScores()
    {
        return $this->games()->where('score1', '!=', null)->where('score2', '!=', null);
    }

    public function poolsInPreviousStage()
    {
        $pools = DB::table('pools')
            ->where('tournament_id', '=', $this->tournament->id)
            ->where('stage', '=', $this->stage - 1)
            ->get();
        return $pools;
    }

    public function rankings()
    {
        $teams = $this->listTeams();
        $games = $this->games;
        $rankings = array();


        foreach ($games as $key => $game) {


            // for classement ----------------------------------------------------------
            if (!empty($teams)) {
                foreach ($teams as $id => $team) {
                    $score          = 0;
                    $win          = 0;
                    $loose       = 0;
                    $draw          = 0;
                    $goalBalance = 0;


                    $position = -1;
                    // check if team is already in ranking
                    foreach ($rankings as $key => $ranking) {
                        if ($ranking["team_id"] == $id) {
                            $position = $key;
                            break;
                        }
                    }
                    // if so get old ranking values
                    if ($position != -1) {
                        $score             = $rankings[$position]["score"];
                        $win             = $rankings[$position]["W"];
                        $loose             = $rankings[$position]["L"];
                        $draw             = $rankings[$position]["D"];
                        $goalBalance     = $rankings[$position]["+-"];
                    }


                    if ((!empty($game->score_contender1) || !empty($game->score_contender2)) && !empty($game->contender1->team) && !empty($game->contender2->team)) {
                        if ($game->contender1->team->name == $team || $game->contender2->team->name == $team) {
                            // $team had a draw
                            if ($game->score_contender1 == $game->score_contender2) {
                                $score += 1;
                                $draw++;
                            }
                            // $team won the game
                            else if (
                                $game->score_contender1 > $game->score_contender2 && $game->contender1->team->name == $team ||
                                $game->score_contender2 > $game->score_contender1 && $game->contender2->team->name == $team
                            ) {
                                $score += 2;
                                $win++;
                            }
                            // $team lost the game
                            else {
                                $loose++;
                            }

                            // calcul the balance between goal+ ($team) and goal- (contender)
                            if ($game->contender1->team->name == $team) {
                                $goalBalance += $game->score_contender1;
                                $goalBalance -= $game->score_contender2;
                            } else if ($game->contender2->team->name == $team) {
                                $goalBalance += $game->score_contender2;
                                $goalBalance -= $game->score_contender1;
                            }
                        }
                    }

                    if ($position == -1) {
                        $rankings[] = array(
                            "team_id"     => $id,
                            "team"         => $team,
                            "score"     => $score,
                            "W"         => $win,
                            "L"         => $loose,
                            "D"         => $draw,
                            "+-"         => $goalBalance
                        );
                    } else {
                        $rankings[$position] = array(
                            "team_id"     => $id,
                            "team"         => $team,
                            "score"     => $score,
                            "W"         => $win,
                            "L"         => $loose,
                            "D"         => $draw,
                            "+-"         => $goalBalance
                        );
                    }
                }
            }
        }
        $rankings = sizeof($rankings) > 0 ? $this->sort($rankings) : array();
        return $rankings;
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'contenders', 'pool_id', 'team_id');
    }



    public function listTeams()
    {
        $teams = array();
        foreach ($this->games as $game) {
            if (!empty($game->contender1->team)) {
                $teams[$game->contender1->team->id] = $game->contender1->team->name;
            }
            if (!empty($game->contender2->team)) {
                $teams[$game->contender2->team->id] = $game->contender2->team->name;
            }
        }
        return $teams;
    }

    private function sort($rankings_row)
    {
        $rankings_sort = array();
        foreach ($rankings_row as $key => $value) {
            $rankings_sort['score'][$key] = $value['score'];
            $rankings_sort['+-'][$key] = $value['+-'];
        }
        array_multisort($rankings_sort['score'], SORT_DESC, $rankings_sort['+-'], SORT_DESC, $rankings_row);

        return $rankings_row;
    }

    //TODO: Move this method into a laravel policy
    public function isEditable()
    {

        if (Gate::allows('isOrg') || Gate::allows('isGest') || Gate::allows('isAdmin')) return ($this->poolState == PoolState::Prep);

        return false;
    }
    //TODO Create a function to see if the pool is

    /**
     * Return true if it's ready to begin
     * @return bool
     */
    public function isReady()
    {
        foreach ($this->contenders as $contender) {
            if (!$contender->team_id) return false;
        }
        if ($this->poolState == PoolState::Prep) return true;
    }

    /**
     * Return true if score contenders are set and the pool is in the prep state
     *
     * @return boolean
     */
    public function areAllGamesPlayed(): bool
    {
        $flag = false;
        foreach ($this->games as $game) {
            if ($game->score_contender1 === null && $game->score_contender2 === null)
                $flag = false;
            elseif ($this->poolState == PoolState::Inprog)
                $flag = true;
        }
        return $flag;
    }

    //TODO: Move this method into a laravel policy
    public function allowMatchesGeneration()
    {
        $contenders = $this->contenders()->get();

        if (!(Gate::allows('isOrg') || Gate::allows('isAdmin'))) return false;

        if (!$this->tournament->event->isPrepOrRegistered()) return false;

        if ($this->poolState !== 0) return false;

        if ($this->games()->count() > 0) return false;

        if ($this->stage > 1 && count($contenders) !== $this->poolSize) return false;

        return true;
    }

    /**
     * This function will generate the contenders for the poolSize
     *
     * @return void
     */
    public function generateContenders()
    {
        $contendersExist = $this->contenders()->get();
        if (count($contendersExist) < $this->poolSize) {
            $numberOfContendersToGenerate = $this->poolSize - count($contendersExist);
            for ($i = 0; $i < $numberOfContendersToGenerate; $i++) {
                Contender::create([
                    'pool_id' => $this->id,
                ]);
            }
        }
    }

    public function generateGames()
    {

        if ($this->stage === 1) {
            $this->generateContenders();
        }

        $poolMode = $this->mode->planningAlgorithm;
        switch ($poolMode) {
            case PoolMode::SINGLE_ELIMINATION:
                $this->generateSimpleOrDoubleGames(false);
                break;
            case PoolMode::DOUBLE_ELIMINATION:
                $this->generateSimpleOrDoubleGames(true);
                break;
            case PoolMode::DIRECT_ELIMINATION:
                throw new \Exception('Not implemented');
                break;
            default:
                throw new \Exception("Pool mode not implemented");
                break;
        }
    }

    // TODO: Handle scheduling of games in the future and Cout of games in the pool
    public function generateSimpleOrDoubleGames(bool $isReturnMatche)
    {
        $teams = $this->contenders()->get();

        $schedule = RoundRobinService::makeSchedule($teams, doubleRound: $isReturnMatche)->collapse()->all();

        foreach ($schedule as $key => $round) {
            $date = new \DateTime($this->start_time);
            $date->modify('+' . $key . ' Minutes');

            Game::create([
                'contender1_id' => $round['local']->id,
                'contender2_id' => $round['visitor']->id,
                'court_id' => 1,
                'date' => $this->tournament->start_date,
                'start_time' => $date->format('H:i:s'),
            ]);
        }
    }

    public function doesContenderNotExistInThisPool(int $rankInPool, int $poolFromId)
    {
        return is_null($this->contenders->where('rank_in_pool', $rankInPool)->where('pool_from_id', $poolFromId)->first());
    }
}
