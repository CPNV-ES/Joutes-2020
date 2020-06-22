<?php

namespace App\Http\Controllers;

use App\Contender;
use App\Event;
use App\Http\Requests\CreateTournamentRequest;
use App\Http\Requests\UpdateTournamentRequest;
use App\Pool;
use App\Tournament;
use App\Sport;

use Illuminate\Http\Request;

class TournamentController extends Controller
{
    public function create(Request $request, Event $event)
    {
        $sports = Sport::all();
        return view('tournaments.create')->with(compact('sports', 'event'));
    }

    public function store(CreateTournamentRequest $request, Event $event)
    {
        $tournament = new Tournament();
        $tournament->fill($request->all());
        $tournament->event()->associate($event);

        $tournament->start_date = $request->input('start_date').' '.$request->input('start_hour').':00';
        $tournament->end_date = $request->input('end_date').' '.$request->input('end_hour').':00';

        $tournament->save();
        
        return redirect()->route('tournaments.show', ['tournament' => $tournament]);
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

        foreach ($tournaments as $tournament) {
            if (empty($tournament->img)) {
                $tournament->img = 'default.jpg';
            }
        }

        return view('tournaments.index', compact('tournaments'));
    }

    public function update(UpdateTournamentRequest $request, Tournament $tournament)
    {
        $tournament->fill($request->all());

        $tournament->start_date = $request->input('start_date').$request->input('start_hour').':00';
        $tournament->end_date = $request->input('end_date').$request->input('end_hour').':00';

        $tournament->save();

        return redirect()->route('tournaments.show', ['tournament' => $tournament]);
    }

    //Display a specific tournament
    public function show(Tournament $tournament)
    {
        $pools = $tournament->pools;
        $maxStage = $pools->max('stage');

        $tournament->getStages();

        return view('tournaments.show', compact('tournament', 'maxStage', 'pools'));

    }
}
