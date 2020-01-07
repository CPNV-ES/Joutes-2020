<?php

namespace App\Http\Controllers;

use App\Pool;
use App\Tournament;
use Illuminate\Http\Request;

class TournamentController extends Controller
{
    public function create(Request $request)
    {
        return view('tournament.create');
    }

    public function store(Request $request)
    {
        $tournament = Tournament::create($request->all());
        return redirect()->action('TournamentController@edit', ['tournament' => $tournament]);
    }

    public function edit(Tournament $tournament)
    {
        return view('tournament.edit')->with('tournament', $tournament);
    }
}
