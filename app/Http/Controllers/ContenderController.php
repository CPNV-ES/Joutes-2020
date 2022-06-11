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

        $data = $request->all();

        if ($request->contender)
            $data = json_decode($request->contender, true);

        $contender = new Contender();
        $contender->fill($data);
        $contender->pool()->associate($pool);

        // so it is required to check if the contender is already inserted
        if ($contender->alreadyInserted()) {
            // TODO: redirect with an error message and show it to the user
            return redirect()->back();
        }

        $contender->save();

        return redirect()->back();
    }

    public function update(Request $request, $pool_id, $contender)
    {
        $contender = Contender::findOrFail($contender);
        $contender->team_id = $request->input('team_id');
        $contender->save();

        return redirect()->back();
    }

    public function destroy($team_id, $pool_id)
    {
        $pool = Pool::findOrFail($pool_id);

        // $contender = Contender::where('team_id','=',$team_id)->firstOrFail();
        // $game_contender1 = Game::where('contender1_id','=',$contender->id);
        // $game_contender2 = Game::where('contender2_id','=',$contender->id);
        // $game_contender1->delete();
        // $game_contender2->delete();
        // $pool->teams()->detach($team_id);
        $pool->teams()->updateExistingPivot($team_id, ['team_id' => null]);

        // $contender->delete();

        return redirect()->back();
    }
}
