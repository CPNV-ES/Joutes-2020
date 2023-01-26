<?php

namespace App\Http\Controllers;

use App\Enums\EventState;
use App\Http\Requests\StoreEventRoleUserRequest;
use App\Http\Requests\UpdateEventRoleUserRequest;
use App\Models\Event;
use App\Models\EventRoleUser;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

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


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EventRoleUser $eventRoleUser
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRoleUserRequest $request, Event $event, EventRoleUser $eventRoleUser)
    {
        // TODO Refactor with Policy
        if (!$event->isRegisterOrReady()) {
            abort(403);
        }

        $eventRoleUser->role_id =  Role::findBySlug($request->engagement)->id;
        $eventRoleUser->save();

        // dd("Les rôles de " . $eventRoleUser->user->username . " / " . $eventRoleUser->user->last_name . " " . $eventRoleUser->user->first_name . " ont été changées pour l'évènement " . $event->name);
        // session(['success' => "Les permissions de " . $eventRoleUser->user()->username . " / " . $eventRoleUser->user()->last_name . " " . $eventRoleUser->user()->first_name . " ont été changées"]);
        return redirect()->back()->with('success', "Les rôles de " . $eventRoleUser->user->username . " / " . $eventRoleUser->user->last_name . " " . $eventRoleUser->user->first_name . " ont été changées pour l'évènement " . $event->name);
    }
}
