<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tournament;
use App\Pool;
use App\Contender;

class ResultTournamentControllers extends Controller
{
    public function show(Request $request){
        $tournament = Tournament::find($request->route('id'));
        $pools = $tournament->getPoolsByTournamentId($tournament);
        $maxStage = $pools->max('stage');

        $pool = Pool::find($request->route('pool_id'));
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
        //dd($pool->rankings());

        return view('tournaments/tournamentResults', compact('tournament', 'maxStage', 'pools', 'pool', 'contenders', 'ranking_completed', 'games_completed', 'games'));
    }
}
