<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Sport;

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

        foreach ($events as $event) {
            if (empty($event->img)) {
                $event->img = 'default.jpg';
            }
        }

        return view('events.index')->with('events', $events);

    }

    public function show(Request $request, Event $event)
    {
        $tournaments = $event->tournaments;

        $sports = Sport::all();

        foreach ($tournaments as $tournament) {
            if (empty($tournament->img)) {
                $tournament->img = 'default.jpg';
            }
        }

        return view('events.show', compact('tournaments', 'event', 'sports'));
    }
}
