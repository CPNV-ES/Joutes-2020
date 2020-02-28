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

        $rankings = $pool->rankings();

        $ranking_completed = true;
        foreach ($rankings as $ranking) {
            if ($ranking["team_id"] == -1) {
                $ranking_completed = false;
                break;
            }
        }

        return view('tournaments/tournamentResults', compact('tournament', 'maxStage', 'pools', 'pool', 'contenders', 'ranking_completed'));
    }
}
