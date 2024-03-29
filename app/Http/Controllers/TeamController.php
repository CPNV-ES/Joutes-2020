<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTeamRequest;
use App\Models\Team;
use App\Models\TeamUser;
use App\Models\Tournament;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function create(Request $request, Tournament $tournament)
    {
        return view('teams.create')->with(compact('tournament'));
    }

    public function show(Team $team)
    {

        $members = TeamUser::where('team_id',$team->id)->get();
        $tournament = Tournament::find($team->tournament_id);
        return view('teams.show',compact('members', 'team','tournament'));
    }

    public function store(CreateTeamRequest $request, Tournament $tournament)
    {
        $team = $request->validate([
            'name' => ['required', 'min:5']
        ]);
        if (Tournament::isNewTeam($team['name'], $tournament)) {
            Team::newTeam($tournament,$team);
            return redirect()->route('tournaments.show', ['tournament' => $tournament])
                ->with('success', ' votre équipe a été créée.');
        } else {
            return redirect()->route('tournaments.teams.create', compact('tournament'))
                ->with('error', 'Ce nom est déjà pris.');
        }

    }

    public function update(Request $request, Team $team)
    {
        $team->setFlag($request['flag_name'], $request['flag_value']);
        $team->save();
        return redirect()->route('tournaments.show', ['tournament' => $team->tournament])
            ->with('success', "Équipe $team->name " . $request['flag_message']);

    }
}
