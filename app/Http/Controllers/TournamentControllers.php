<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TournamentControllers extends Controller
{
    public function index()
    {
        return view('tournament/tournamentResults');
    }
}
