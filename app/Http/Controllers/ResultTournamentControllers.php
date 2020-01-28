<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tournament;
use App\Pool;
use App\Team;

class ResultTournamentControllers extends Controller
{
    public function show($id , $pool_id){

        $tournament = Tournament::find($id);
        $pools = $tournament->getPoolsByTournamentId($tournament);
        $maxStage = $pools->max('stage');
        $team =

        return view('tournaments/tournamentResults', compact('tournament', 'maxStage', 'pools'));
    }
}
