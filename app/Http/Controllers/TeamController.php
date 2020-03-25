<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tournament;

class TeamController extends Controller
{
    public function create(Request $request, Tournament $tournament)
    {
        return view('teams.create')->with(compact('tournament'));
    }
}
