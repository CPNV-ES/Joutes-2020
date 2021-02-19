<?php

namespace App\Http\Controllers;

use App\Contender;
use App\Event;
use App\Http\Requests\CreateTournamentRequest;
use App\Http\Requests\UpdateTournamentRequest;
use App\Pool;
use App\Tournament;
use App\Sport;
use App\Game;

use Illuminate\Http\Request;

class TournamentController extends Controller
{
    public function create(Request $request, Event $event)
    {
        $sports = Sport::all();
        $tournaments = Tournament::all();
        return view('tournaments.create')->with(compact('sports', 'event', 'tournaments'));
    }

    public function store(CreateTournamentRequest $request, Event $event)
    {
        switch ($request->input('action')) {
            case 'save' :
                $tournament = new Tournament();
                $tournament->fill($request->all());
                $tournament->event()->associate($event);

                $tournament->start_date = $request->input('start_date').' '.$request->input('start_hour').':00';
                $tournament->end_date = $request->input('end_date').' '.$request->input('end_hour').':00';

                $tournament->save();

                break;
            case 'copy' :
                $tournament = new Tournament();
                $selectedTournament = Tournament::find($request->input('tournament_id'));

                $tournament->fill($request->all());

                $tournament->img = $selectedTournament->img;
                $tournament->max_teams = $selectedTournament->max_teams;
                $tournament->event()->associate($event);

                $tournament->start_date = $request->input('start_date').' '.$request->input('start_hour').':00';
                $tournament->end_date = $request->input('end_date').' '.$request->input('end_hour').':00';

                $tournament->save();

                // Zone to copy pools
                $tournamentId = $tournament->id;
                $oldPools = Pool::all();
                //$oldContenders = Contender::all();
                //$oldGames = Game::all();

                foreach ($oldPools as $oldPool){
                    if($oldPool->tournament_id == $request->input('tournament_id')) {
                        $pool = new Pool();
                        $pool->start_time = $oldPool->start_time;
                        $pool->end_time = $oldPool->end_time;
                        $pool->poolName = $oldPool->poolName;
                        $pool->stage = $oldPool->stage;
                        $pool->poolSize = $oldPool->poolSize;
                        $pool->poolState = 0;

                        $pool->mode_id = $oldPool->mode_id;
                        $pool->game_type_id = $oldPool->game_type_id;

                        $pool->tournament_id = $tournamentId;

                        $pool->save();
                        $C1 = 0;
                        /*foreach ($oldContenders as $oldContender){
                            if($oldContender->pool_id == $oldPool->id) {
                                $contender = new Contender();
                                $contender->pool_id = $pool->id;

                                $contender->save();
                                foreach ($oldGames as $oldGame){
                                    if($oldGame->contender1_id == $oldContender->id){
                                        $game = new Game();
                                        $game->date = $request->input('start_date');
                                        $game->start_time = $oldGame->start_time;
                                        $game->contender1_id = $contender->id;
                                        $game->contender2_id = $contender->id;
                                        $game->court_id = $oldGame->court_id;

                                        $game->save();
                                    }
                                }

                            }


                        }*/
                    }
                }

                break;
        }

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
