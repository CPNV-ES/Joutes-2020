<?php

namespace App\Http\Controllers;

use App\Event;
use App\Sport;
use App\Student;
use App\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\PseudoTypes\LowercaseString;

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($eventId)
    {
        $event = Event::find($eventId);
        $tournaments = $event->tournamentsReady();
        return view('events.carousel.show')->with(compact('tournaments', 'event'));
    }
}
