<?php

namespace App\Http\Controllers;


use App\Event;
use App\Enums\EventState;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreEventEngagementRequest;

class EventEngagementController extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Event $event)
    {
        return view('events.engagements.create')->with(compact('event'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventEngagementRequest $request, Event $event)
    {
        if ($event->eventState !== EventState::Register) {
            abort(403);
        }
        dd($event->users()->get());
    }
}
