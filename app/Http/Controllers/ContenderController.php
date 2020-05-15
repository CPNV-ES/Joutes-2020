<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contender;
use App\Pool;
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
}
