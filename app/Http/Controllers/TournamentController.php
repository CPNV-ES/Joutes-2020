<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTournamentRequest;
use App\Tournament;
use App\Pool;
use App\Sport;
use App\Team;

use Illuminate\Http\Request;

class TournamentController extends Controller
{
    public function store(CreateTournamentRequest $request)
    {
        $tournament = Tournament::create($request->all());
        return redirect()->action('TournamentController@edit', ['tournament' => $tournament]);
    }

    public function edit(Tournament $tournament)
    {
        return view('tournaments.edit')->with('tournament', $tournament);
    }

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
    public function show(Request $request, $id)
    {
        $tournament = Tournament::find($id);
        $pools = $tournament->getPoolsByTournamentId($tournament);
        $maxStage = $pools->max('stage');

        return view('tournaments.show', compact('tournament', 'maxStage', 'pools'));

    }
}
