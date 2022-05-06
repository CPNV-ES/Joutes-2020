@extends('layout')
@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <h1>
                    Mon programme de l'événement <a href="{{ route('events.show', $event) }}">{{ $event->name }}</a>
                </h1>
                <hr>
            </div>
        </div>

        <div class="row">
            {!! $calendar->calendar() !!}
            {!! $calendar->script() !!}
        </div>
    </div>

@stop
