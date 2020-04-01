<?php

namespace App\Http\Controllers;

use App\GameType;
use App\Http\Requests\CreatePoolRequest;
use App\Pool;
use App\Team;
use App\PoolMode;
use App\Tournament;
use Illuminate\Http\Request;

class PoolController extends Controller
{
  public function create(Request $request, Tournament $tournament)
  {
    $poolModes = PoolMode::all();
    $gameTypes = GameType::all();
    return view('pools.create')->with(compact('poolModes', 'gameTypes', 'tournament'));
  }

  public function store(CreatePoolRequest $request, Tournament $tournament)
  {
    $pool = new Pool();
    $pool->fill($request->all() + ['tournament_id' => $tournament->id]);

    $pool->start_time = $request->input('start_time');
    $pool->end_time = $request->input('end_time');
    $pool->isFinished = false;

    $pool->save();

    return redirect()->route('tournaments.show', ['tournament' => $tournament]);
  }

  public function show(Request $request, Tournament $tournament, Pool $pool)
  {
    $pools = $tournament->pools;
    $maxStage = $pools->max('stage');

    $contenders = $pool->contenders;
    $games = $pool->games->sortBy("start_time");

    $rankings = $pool->rankings();

    $ranking_completed = true;
    foreach ($rankings as $ranking) {
        if ($ranking["team_id"] == -1) {
            $ranking_completed = false;
            break;
        }
    }

    $games_completed = true;
    foreach ($games as $game) {
        if ($game->score_contender1 === null || $game->score_contender2 === null) {
            $games_completed = false;
            break;
        }
    }

    $teams = $tournament->getTeamsNotInAPool();

    return view('pools.show')->with(compact('tournament', 'maxStage', 'pools', 'pool', 'contenders', 'ranking_completed', 'games_completed', 'games', 'rankings', 'teams'));
  }
}
