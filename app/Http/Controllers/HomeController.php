<?php

namespace App\Http\Controllers;

use App\Event;
use App\Enums\EventState;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class HomeController extends Controller
{
    public function index()
    {
        $eventReady = Auth::user() ? Auth::user()->events()->where('eventState', EventState::Ready)->get() : new Collection([]);
        $eventFinished = Auth::user() ? Auth::user()->events()->where('eventState', EventState::Finished)->get() : new Collection([]);
        $states = Event::where('eventState', EventState::Register)->get()->merge($eventReady)->merge($eventFinished)->groupBy('eventState');
        return view('homes.index', compact('states'));
    }
}
