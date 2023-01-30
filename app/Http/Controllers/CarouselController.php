<?php

namespace App\Http\Controllers;

use App\Models\Event;
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
        $event = Event::findOrFail($eventId);
        $tournaments = $event->tournamentsReady();
        if (empty($tournaments)) {
            return redirect()->route('events.index');
        }
        return view('events.carousel.show')->with(compact('tournaments', 'event'));
    }
}
