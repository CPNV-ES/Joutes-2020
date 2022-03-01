<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tournament;
use App\Team;
use App\Http\Requests\CreateTeamRequest;

class TeamController extends Controller
{
    public function create(Request $request, Tournament $tournament)
    {
        return view('teams.create')->with(compact('tournament'));
    }

    public function store(CreateTeamRequest $request, Tournament $tournament)
    {
        $newTeam =$request->validate([
            'name'=> ['required','min:5']
        ]);
        if(Tournament::isNewTeam($newTeam['name'], $tournament)){
            $team = new Team();
            $team->fill($newTeam);
            $team->tournament()->associate($tournament);
            $team->save();

            return redirect()->route('tournaments.show', ['tournament' => $tournament])
                ->with('success',' votre équipe a été créée.');
        }else{
            return redirect()->route('tournaments.teams.create', compact('tournament') )
                ->with('error','Ce nom est déjà pris.');
        }

    }
}
