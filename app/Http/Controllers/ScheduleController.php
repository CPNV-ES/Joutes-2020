<?php

namespace App\Http\Controllers;

use App\Event;
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
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $events = [];

        $events[] = Calendar::event(
            'Event One', //event title
            false, //full day event?
            '2022-02-11T0800', //start time (you can also use Carbon instead of DateTime)
            '2022-02-12T0800', //end time (you can also use Carbon instead of DateTime)
            0 //optionally, you can specify an event ID
        );

        $calendar = new Calendar();
        $calendar->addEvents($events)
            ->setOptions([
                'plugins' => ['window.dayGridPlugin', 'window.timeGridPlugin', 'window.listPlugin'],
                'locales' => 'window.allLocales',
                'locale' => 'fr',
                'firstDay' => 0,
                'initialView' => 'timeGridDay',
                'displayEventTime' => true,
                'selectable' => true,
                'initialView' => 'timeGridWeek',
                'slotMinTime' => '07:00:00',
                'slotMaxTime' => '22:00:00',
                'contentHeight' => 'auto',
                'headerToolbar' => [
                    'left' => 'prev,next today',
                    'center' => 'title',
                    'right' => 'dayGridMonth,timeGridWeek,timeGridDay'
                ],
            ]);
        $calendar->setEs6();

        return view('events.schedules.index', compact('calendar'));
    }
}
