<!-- @author Yvann -->
@extends('layout')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <h1>
                    Evénements
                    @if (Auth::check())
                        @if (Auth::user()->role->slug == 'ADMIN')
                            <a href="{{ route('events.create') }}" class="btn btn-main" title="Créer un événement">
                                <i class="fa fa-solid fa-plus fa-1x" aria-hidden="true"></i>
                            </a>
                        @endif
                    @endif
                </h1>

                <hr>
            </div>
        </div>

        <div class="row">
            @foreach ($events as $event)
                <x-event :event="$event">
                    @if ((Gate::allows('isStudent') || Gate::allows('isGest')) && $event->user(Auth::user())->first())
                        <span class="badge badge-success"> Inscrit
                            ({{ \App\Engagement::find($event->user(Auth::user())->first()->pivot->engagement_id)->name }})
                        </span>
                    @endif
                    <span class="badge badge-light">
                        {{ \App\Enums\EventState::eventStateName($event->eventState) }}
                    </span>
                </x-event>
            @endforeach
            @if (count($events) == 0)
                <div class="col-md-12">Aucun événement pour l'instant...</div>
            @endif
        </div>
    </div>
@stop
