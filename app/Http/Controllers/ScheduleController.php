<?php

namespace App\Http\Controllers;

use App\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Acaronlex\LaravelCalendar\Calendar;



class ScheduleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Event $event)
    {
        // dd(route('homepage'));
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $events = [];

        foreach ($event->allTournamentsRelatedToAUser(Auth::user()) as $tournament) {
            // dd($tournament);
            // var_dump(route('tournaments.teams.show', [$tournament->teams_id, $tournament->id]));
            $events[] = Calendar::event(
                "{$tournament->name} - {$tournament->teams_name}",
                false,
                Carbon::parse($tournament->start_date)->toDateTimeLocalString(),
                Carbon::parse($tournament->end_date)->toDateTimeLocalString(),
                $tournament->id,
                [
                    'url' => route('tournaments.show', $tournament->id),
                ]
            );
        }

        $calendar = new Calendar();
        $calendar->addEvents($events)
            ->setOptions([
                'plugins' => ['window.dayGridPlugin', 'window.timeGridPlugin', 'window.listPlugin'],
                'timeZone' => 'UTC',
                'locales' => 'window.allLocales',
                'locale' => 'fr',
                'initialView' => 'timeGridDay',
                'displayEventTime' => true,
                'selectable' => true,
                'initialView' => 'timeGridWeek',
                'slotMinTime' => '07:00:00',
                'slotMaxTime' => '22:00:00',
                'contentHeight' => 'auto',
                'editable' => true,
                'headerToolbar' => [
                    'left' => 'prev,next today',
                    'center' => 'title',
                    'right' => 'dayGridMonth,timeGridWeek,timeGridDay'
                ],
                'eventBackgroundColor' =>  '#00a651',
                'eventBorderColor' => '#009933',
            ]);
        $calendar->setEs6();

        return view('events.schedules.index', compact('calendar', 'event'));
    }
}
