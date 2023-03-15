<?php

namespace App\Http\Controllers;

use App\Enums\EventState;
use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Array_;

class HomeController extends Controller
{
    public function index()
    {
        /*   $eventReady = Auth::user() ? Auth::user()->events()->where('eventState', EventState::Ready)->get() : new Collection([]);
           $eventFinished = Auth::user() ? Auth::user()->events()->where('eventState', EventState::Finished)->get() : new Collection([]);
           $states = Event::where('eventState', EventState::Register)->get()->merge($eventReady)->merge($eventFinished)->groupBy('eventState');
           return view('homes.index', compact('states'));
       }*/

            $userEvents = Auth::user() ? Auth::user()->events()->pluck('eventState') : new Collection([]);
            $allEvents = Event::pluck('eventState');
            //$eventsReady = Auth::user() ? Auth::user()->events()->where('eventState', EventState::Ready)->get() : new Collection([]);
           // $eventsFinished = Auth::user() ? Auth::user()->events()->where('eventState', EventState::Finished)->get() : new Collection([]);

        // $events = Auth::user()->events()->pluck('eventState'); -> pluck can get the whole column in the table
        return view('homes.index', compact('userEvents', 'allEvents'));
    }
}

