<?php

namespace App\Http\Controllers;

use App\Role;
use App\Event;
use App\EventRoleUser;
use App\Enums\EventState;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreEventRoleUserRequest;

class EventRoleUserController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Event $event)
    {
        if (EventRoleUser::findByEventAndEvent(Auth::user(), $event))
            return redirect()->route('events.show', $event)->with('error', 'Vous êtes déjà inscrit à cette évènement !');

        return view('events.engagements.create')->with(compact('event'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventRoleUserRequest $request, Event $event)
    {
        // TODO Refactor with Policy
        if ($event->eventState != EventState::Register || EventRoleUser::findByEventAndEvent(Auth::user(), $event)) {
            abort(403);
        }

        EventRoleUser::create([
            'user_id' => Auth::user()->id,
            'event_id' => $event->id,
            'role_id' => Role::findBySlug($request->engagement)->id
        ]);

        return redirect()->route('events.show', $event)->with('success', 'Inscription effectuée !');
    }
}
