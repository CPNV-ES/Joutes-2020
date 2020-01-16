<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

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

        // return a list of tournaments for a selected event using ajax
        if ($request->ajax()) {
            $list = array();
            for ($i=0; $i < sizeof($tournaments); $i++) {
                $isMaxLimit = $tournaments[$i]->isComplete(); // tournament complete
                $list[] = ['id' => $tournaments[$i]->id, 'name' => $tournaments[$i]->name, 'start_date' => $tournaments[$i]->start_date, 'end_date' => $tournaments[$i]->end_date, 'isMaxLimiTeams' => $isMaxLimit];
                }
            return $list;

        }

        $event = Event::findOrFail($event_id);
        $tournaments = $event->tournaments;

        foreach ($tournaments as $tournament) {
            if (empty($tournament->img)) {
                $tournament->img = 'default.jpg';
            }
        }

        return view('tournament.index', array(
            "tournaments" => $tournaments,
            "fromEvent" => true,
            "event" => $event
        ));

    }

}
