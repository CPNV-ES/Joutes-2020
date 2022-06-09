<?php

namespace App\Http\Controllers;

use App\Pool;
use Illuminate\Http\Request;

class GameManagerController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Pool $pool)
    {
        $pool->generateContenders();
        $pool->generateSimpleMatches();
        return redirect()->route('tournaments.pools.show', [$pool->tournament, $pool]);
    }
}
