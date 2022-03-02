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

        $eventReady = Auth::user() ? Auth::user()->events()->where('eventState', EventState::Ready)->get() : new Collection([]);;
        $states = $eventReady->merge(Event::where('eventState', EventState::Register)->get())->groupBy('eventState');
        return view('homes.index', compact('states'));
    }
}
