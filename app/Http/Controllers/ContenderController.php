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
    public function create(Request $request, Pool $pool)
    {
        

        $tournament = Tournament::find($pool->tournament_id);

        if($tournament->getTeamsNotInAPool()->count() > Contender::teamNotAssigned($tournament->pools)->count()) {
            return redirect()->back()->with("error", "Il n'y a pas assez de poule pour toute l'équipe");
        }

        while(!$tournament->getTeamsNotInAPool()->isEmpty()){
            $team = $tournament->getTeamsNotInAPool()->first();
            $contender = Contender::teamNotAssigned($tournament->getPoolStage1())->random();
            $contender->team_id = $team->id;
            $contender->save();
        }
        return redirect()->back()->with('success', "Toutes les équipes non assignées sont inscrites.");
    }
 
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
        $contenderPrevious = Contender::Where('team_id', $request->team_id)->get()->last();

        if($pool->stage !== 1 && $pool->id !== null){
            $contender->team_id = $contenderPrevious->team_id;
            $contender->pool_from_id = $contenderPrevious->pool_id;
            $contender->pool_from_rank = $contenderPrevious->rank_in_pool;
            $contender->save();
            return redirect()->back();
        }else{
            $contender->fill($request->all());
            $contender->save();
            return redirect()->back()->with('success', "Equipe ".ContenderHelper::contenderDisplayName($contender) ." inscrite dans ".$pool->poolName);
        }
    }


    public function destroy( Contender $contender)
    {
        $contender->delete();

        return redirect()->back();
    }
}
