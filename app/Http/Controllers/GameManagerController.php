<?php

namespace App\Http\Controllers;

use App\Models\Pool;

class GameManagerController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Pool $pool)
    {
        if ($pool->allowMatchesGeneration()) {
            $pool->generateGames();
        }

        return redirect()->route('tournaments.pools.show', [$pool->tournament, $pool]);
    }
}
