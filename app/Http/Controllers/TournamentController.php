<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TournamentController extends Controller
{
    public function create(Request $request)
    {
        return view('tournament.create');
    }

    public function store(Request $request)
    {
        return redirect()->action('TournamentController@edit', ['id' => 2]);
    }

    public function edit(Request $request)
    {

    }
}
