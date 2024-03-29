<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePoolRequest;
use App\Models\Contender;
use App\Models\Court;
use App\Models\GameType;
use App\Models\Pool;
use App\Models\PoolMode;
use App\Models\Tournament;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;

class PoolController extends Controller
{
    public function create(Request $request, Tournament $tournament)
    {
        $poolModes = PoolMode::all();
        $gameTypes = GameType::all();
        return view('pools.create')->with(compact('poolModes', 'gameTypes', 'tournament'));
    }

    public function store(CreatePoolRequest $request, Tournament $tournament)
    {

        $pool = new Pool();
        $pool->fill($request->all() + ['tournament_id' => $tournament->id]);

        $pool->start_time = $request->input('start_time');
        $pool->end_time = $request->input('end_time');
        $pool->poolState = 0;

        $pool->save();

        for ($i=1; $i <= $pool->poolSize ; $i++) {
            Contender::create([
                'pool_id' => $pool->id,
                'team_id' => null,
                'rank_in_pool' => $i,
                'pool_from_id' => null]);
        }

        return redirect()->route('tournaments.show', ['tournament' => $tournament]);
    }

    public function update(Request $request, Tournament $tournament, Pool $pool)
    {

        if ($request->input("changeStatePool") && !($pool->isReady())) {
            return redirect()->route('tournaments.pools.show', [$tournament, $pool])->with("error", "La poule n'est pas encore prête");
        }

        if (!$pool->isEditable()) {
            return redirect()->route('tournaments.pools.show', [$tournament, $pool])->with("error", "Le changement n'as pas été effectué");
        }

        $pool->fill($request->all());

        $pool->save();

        return redirect()->route('tournaments.pools.show', [$tournament, $pool]);
    }

    public function show(Request $request, Tournament $tournament, Pool $pool)
    {
      $state = array('inprep','ready','inprogress','finished');

      $pools = $tournament->pools;
      $maxStage = $pools->max('stage');

      $contenders = $pool->contenders;
      $games = $pool->games->sortBy("start_time");

      $courts = Court::all();
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

      $teamsNotInAPool = $tournament->getTeamsNotInAPool();
      $poolsInPreviousStage = $pool->poolsInPreviousStage();


      return view('pools.show.'.$state[$pool->poolState])->with(compact('tournament', 'maxStage', 'pool', 'contenders', 'ranking_completed', 'games_completed', 'games', 'rankings', 'teamsNotInAPool', 'poolsInPreviousStage','courts'));
    }

    public function close(Pool $pool)
    {
        $pool = Pool::find($pool->id);
        $pool->poolState = 3;
        $pool->save();

      /*  $rankings = $pool->rankings();

        foreach ($pool->contenders as $contender) {
            for ($i = 0; $i < sizeof($rankings); $i++) {
                if ($contender->team->name == $rankings[$i]["team"]) {
                    $key = $i;
                }
            }
            $contender->rank_in_pool = $key + 1;
            $contender->save();
        }

        $tournament = Tournament::find($pool->tournament_id);
        $poolsWinner = $tournament->getPoolsOfStage($tournament->id, 2);

        $i = 0;
        foreach ($poolsWinner as $poolWinner) {
            foreach ($poolWinner->contenders as $contender) {
                if ($contender->fromPool->id == $pool->id) {
                    $team = Team::find($rankings[$i]["team_id"]);
                    $contender->team()->associate($team->id);

                    $contender->save();

                    $i++;
                }

            }
        }*/


        return back()->with('success', 'La pool a bien été fermée');
    }

    public function destroy(Tournament $tournament, Pool $pool)
    {

        $pool->delete();
        return redirect()->route('tournaments.show', ['tournament' => $tournament]);
    }
}
