<?php

namespace App\Http\Controllers;

use App\Engagement;
use App\Event;
use App\Enums\EventState;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreEventEngagementRequest;
use App\User;
use Illuminate\Support\Facades\Auth;

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

        if ($event->eventState != EventState::Register || count($event->user(Auth::user())->get()) > 0) {
            abort(403);
        }

        $event->users()->attach(Auth::user(), ['engagement_id' =>  Engagement::findBySlug($request->engagement)->id]);

        return redirect()->route('events.show', $event)->with('success', 'Inscription effectuée !');
    }
}
