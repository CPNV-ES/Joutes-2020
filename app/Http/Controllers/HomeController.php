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
        $eventPrep = Auth::user() ? Auth::user()->events()->where('eventState', EventState::Prep)->get() : new Collection([]);
        $eventRegister = Auth::user() ? Auth::user()->events()->where('eventState', EventState::Register)->get() : new Collection([]);
        $eventReady = Auth::user() ? Auth::user()->events()->where('eventState', EventState::Ready)->get() : new Collection([]);
        $eventFinished = Auth::user() ? Auth::user()->events()->where('eventState', EventState::Finished)->get() : new Collection([]);
        $states = $eventPrep->merge($eventRegister)->merge($eventReady)->merge($eventFinished)->groupBy('eventState');
        return view('homes.index', compact('states'));
    }
}

