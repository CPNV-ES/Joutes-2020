<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Sport;

class EventTournamentController extends Controller
{

    public function index(Request $request, $event_id) {
        /*
        // check is it's an api request
        if ($request->is('api/*')) {
            // get event tournaments
            $tournaments = Event::findOrFail($event_id)->tournaments;

            return $this->response->collection($tournaments, new TournamentTransformer, ['key' => 'tournaments']);
        }*/

        $event = Event::findOrFail($event_id);
        $tournaments = $event->tournaments;
        $tournamentFromEvent = true;
        $sports = Sport::all();

        foreach ($tournaments as $tournament) {
            if (empty($tournament->img)) {
                $tournament->img = 'default.jpg';
            }
        }


        return view('tournaments.index', compact('tournaments', 'tournamentFromEvent', 'event', 'sports'));
    }

}
