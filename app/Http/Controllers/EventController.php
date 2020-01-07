<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     *
     * @author Doran Kayoumi, Davide Carboni
     */
    public function index(Request $request) {

        $events = Event::all()->sortByDesc("id");

        // check is it's an api request
        if ($request->is('api/*')) {
            return $events;
        }

        // return a list of events using ajax
        if ($request->ajax()) {
            $list = array();
            for ($i=0; $i < sizeof($events); $i++) {
                    $list[$events[$i]->id] = $events[$i]->name;
            }
            return $list;
        }

        foreach ($events as $event) {
            if (empty($event->img)) {
                $event->img = 'default.jpg';
            }
        }

        return view('event.index')->with('events', $events);

    }
}
