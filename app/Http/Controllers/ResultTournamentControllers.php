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
        //dd($pool->rankings());

        return view('tournaments/tournamentResults', compact('tournament', 'maxStage', 'pools', 'contenders'));
    }
}
