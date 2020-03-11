<?php

namespace App\Http\Controllers;

use App\Tournament;
use App\Pool;
use App\Team;

use Illuminate\Http\Request;

class TournamentController extends Controller
{
    //Display all the tournaments
    public function index()
    {
        $tournaments = Tournament::all()->sortBy("start_date");
        $tournamentFromEvent = false;

        foreach ($tournaments as $tournament) {
            if (empty($tournament->img)) {
                $tournament->img = 'default.jpg';
            }
        }

        return view('tournaments.index', compact('tournaments', 'tournamentFromEvent'));
    }



    //Display a specific tournament
    public function show(Tournament $tournament)
    {
        $pools = $tournament->getPoolsByTournamentId($tournament);
        $maxStage = $pools->max('stage');

        return view('tournaments.show', compact('tournament', 'maxStage', 'pools'));

    }
}
