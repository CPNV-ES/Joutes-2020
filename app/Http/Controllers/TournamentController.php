<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTournamentRequest;
use App\Http\Requests\UpdateTournamentRequest;
use App\Models\Contender;
use App\Models\Event;
use App\Models\Game;
use App\Models\Pool;
use App\Models\Sport;
use App\Models\Tournament;
use Illuminate\Http\Request;

class TournamentController extends Controller
{
    public function create(Request $request, Event $event)
    {
        $sports = Sport::all();
        $tournaments = Tournament::all();
        return view('tournaments.create')->with(compact('sports', 'event', 'tournaments'));
    }

    public function store(CreateTournamentRequest $request, $event)
    {
        switch ($request->input('action')) {
            case 'save' :
                $tournament = new Tournament();
                $tournament->fill($request->all());
                $tournament->event()->associate($event);

                $tournament->start_date = $request->input('start_date') . ' ' . $request->input('start_hour') . ':00';
                $tournament->end_date = $request->input('end_date') . ' ' . $request->input('end_hour') . ':00';

                $tournament->save();

                break;
            case 'copy' :
                // Duplicate Tournament
                $tournament = new Tournament();
                $selectedTournament = Tournament::find($request->input('tournament_id'));

                $tournament->fill($request->all());

                $tournament->img = $selectedTournament->img;
                $tournament->max_teams = $selectedTournament->max_teams;
                $tournament->event()->associate($event);

                $tournament->start_date = $request->input('start_date') . ' ' . $request->input('start_hour') . ':00';
                $tournament->end_date = $request->input('end_date') . ' ' . $request->input('end_hour') . ':00';

                $tournament->save();

                $oldPools = $selectedTournament->pools;

                $diff = 0;
                // Duplicate Pool
                foreach ($oldPools as $oldPool) {
                    $pool = new Pool();
                    $pool->start_time = $oldPool->start_time;
                    $pool->end_time = $oldPool->end_time;
                    $pool->poolName = $oldPool->poolName;
                    $pool->stage = $oldPool->stage;
                    $pool->poolSize = $oldPool->poolSize;
                    $pool->poolState = 0;
                    $pool->mode()->associate($oldPool->mode);
                    $pool->game_type()->associate($oldPool->game_type);

                    $pool->tournament()->associate($tournament);

                    $pool->save();

                    $contenderArray = [];
                    $diff = $pool->id - $oldPool->id;


                    // Duplicate Contenders
                    foreach ($oldPool->contenders as $oldContender) {

                        $contender = new Contender();

                        $contender->pool()->associate($pool);
                        $contender->rank_in_pool = $oldContender->rank_in_pool;

                        if ($oldContender->pool_from_id !== null) {
                            $contender->pool_from_id = $oldContender->pool_from_id + $diff;
                        }

                        $contender->save();


                        array_push($contenderArray, $contender);

                    }

                    // Duplicate Game
                    $i = 0;
                    foreach ($oldPool->games as $oldGame) {
                        if($i + 1 < count($contenderArray)) {
                            $game = new Game();
                            $game->date = $request->input('start_date');
                            $game->start_time = $oldGame->start_time;
                            $game->contender1()->associate($contenderArray[$i]);
                            $game->contender2()->associate($contenderArray[$i + 1]);
                            $game->court()->associate($oldGame->court_id);
                            $game->save();
                        }
                        $i++;
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

        $tournament->start_date = $request->input('start_date') . $request->input('start_hour') . ':00';
        $tournament->end_date = $request->input('end_date') . $request->input('end_hour') . ':00';

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
