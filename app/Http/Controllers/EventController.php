<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEventRequest;
use App\Role;
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

    protected $table = 'events';

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

    public function create(Request $request) {

        return view('events.create');

    }

    public function store(CreateEventRequest $request)
    {
        $image = $request->file('picture');

        $imageName = time()."_".$image->getClientOriginalName();

        $image->move(public_path('images/joutes'), $imageName);

        $newEvent = new Event();

        $newEvent->name = $request->input("name");

        $newEvent->img = $imageName;

        $newEvent->eventState = 0;

        $newEvent->save();
        return redirect()->route('events.index');


    }

    public function update(Request $request, Event $event){
        if ($event->eventState < 3) {
            $event->eventState = $event->eventState + 1;
        }

        $tournaments = $event->tournaments;

        foreach ($tournaments as $tournament) {
            if (empty($tournament->img)) {
                $tournament->img = 'default.jpg';
            }
        }
        $event->save();
        return redirect()->refresh();
    }

}
