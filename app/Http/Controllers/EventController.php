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

        foreach ($events as $event) {
            if (empty($event->img)) {
                $event->img = 'default.jpg';
            }
        }

        return view('events.index')->with('events', $events);

    }
}
