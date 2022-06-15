<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contender;
use App\Pool;
use App\Team;
use App\Game;
use App\Helpers\ContenderHelper;
use App\Tournament;
use Illuminate\Support\Facades\Redirect;

class ContenderController extends Controller
{
    public function store(Request $request, Pool $pool)
    {
        $tournament = Tournament::find($pool->tournament_id);

        if($pool->stage == 1 && $pool->id !== null){
            Contender::create([
                'pool_id' => $pool->id,
                'team_id' => explode(':', $request->team_id)[0],
                'rank_in_pool' => explode(':', $request->team_id)[1]+1,
                'pool_from_id' => null]);

        }
        else{
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
        }


        return redirect()->route('tournaments.show',compact('tournament'));
    }

    public function update(Request $request,Pool $pool, Contender $contender)
    {
        if($pool->stage !== 1 && $pool->id !== null){
            $contender->team_id = explode(':', $request->team_id)[0];
            $contender->pool_from_id = explode(':', $request->team_id)[1];
        }else{
            $contender->fill($request->all());
        }

        $contender->save();
        return redirect()->back()->with('success', "Equipe ".ContenderHelper::contenderDisplayName($contender) ." inscrite dans ".$pool->poolName);
    }

    public function destroy( Contender $contender)
    {
        $contender->delete();

        return redirect()->back();

    }

}
