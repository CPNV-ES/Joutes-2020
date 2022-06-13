<?php

namespace App\Http\Controllers;

use App\Event;
use App\Sport;
use App\Student;
use App\User;
use Illuminate\Http\Request;
use Mockery\Undefined;
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
        if ($tournaments == null) {
            return redirect()->route('events.index');
        }
        $pools = $tournaments[0]->poolsReady();
        $games = $pools[0]->gamesWithoutScores();
        $gamess = [];
        foreach ($games as $game) {
            dd($game);
        }
        return view('events.carousel.show')->with(compact('tournaments', 'event'));
    }
}
