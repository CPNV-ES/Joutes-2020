<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contender;
use App\Pool;
use App\Team;
use App\Game;
use Illuminate\Support\Facades\Redirect;

class ContenderController extends Controller
{
    public function store(Request $request, Pool $pool)
    {
        $contender = new Contender();
        $contender->fill($request->all());
        $contender->pool()->associate($pool);

        // if the team ID is not sent, it means we are editing a pool that is not in phase 1
        // so it is required to check if the contender is already inserted
        if (!isset($request->team_id) && $contender->alreadyInserted()) {
            // TODO: redirect with an error message and show it to the user
            return redirect()->back();
        }

        $contender->save();

        return redirect()->route('tournaments.pools.show', [$pool->tournament, $pool]);
    }

    public function update(Request $request,Pool $pool, Contender $contender)
    {
        dd($request);
        $this->destroy($contender->team_id,$pool);

        $contender->team_id = $request->input('team_id');
        $contender->save();

        return redirect()->back();
    }

    public function destroy($team_id, Pool $pool)
    {

        // $contender = Contender::where('team_id','=',$team_id)->firstOrFail();
        // $game_contender1 = Game::where('contender1_id','=',$contender->id);
        // $game_contender2 = Game::where('contender2_id','=',$contender->id);
        // $game_contender1->delete();
        // $game_contender2->delete();
        // $pool->teams()->detach($team_id);
        $pool->teams()->updateExistingPivot($team_id,['team_id'=> null]);

        // $contender->delete();

        return redirect()->back();

    }

}
