<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTournamentRequest;
use App\Http\Requests\UpdateTournamentRequest;
use App\Tournament;
use App\Pool;
use App\Sport;
use App\Team;

use Illuminate\Http\Request;

class TournamentController extends Controller
{
    public function create(Request $request)
    {
        $sports = Sport::all();
        return view('tournaments.create')->with(compact('sports'));
    }

    public function store(Event $event, CreateTournamentRequest $request)
    {
        $tournament = new Tournament();
        $tournament->fill($request->all());

        $tournament->start_date = $request->input('start_date').' '.$request->input('start_hour');
        $tournament->end_date = $request->input('end_date').' '.$request->input('end_hour');

        $tournament->save();
        
        return redirect()->action('TournamentController@edit', ['tournament' => $tournament]);
    }

    public function edit(Tournament $tournament)
    {
        $sports = Sport::all();
        return view('tournaments.edit')->with(compact('tournament', 'sports'));
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

    public function update(UpdateTournamentRequest $request, Tournament $tournament)
    {
        $tournament->fill($request->all());

        $tournament->start_date = $request->input('start_date').$request->input('start_hour');
        $tournament->end_date = $request->input('end_date').$request->input('end_hour');

        $tournament->save();

        return redirect()->route('tournaments.show', ['tournament' => $tournament->id]);
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
