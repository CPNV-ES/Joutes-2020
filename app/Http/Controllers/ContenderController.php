<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contender;
use App\Pool;

class ContenderController extends Controller
{
    public function store(Request $request, Pool $pool)
    {
        $contender = new Contender();
        $contender->fill($request->all());
        $contender->pool()->associate($pool);

        $contender->save();

        return redirect()->route('tournaments.pools.show', [$pool->tournament, $pool]);
    }
}
