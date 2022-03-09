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
                    @if (Gate::allows('isPart') && $event->user(Auth::user()))
                        <span class="badge badge-success"> Inscrit
                            ({{ \App\Helpers\EventHelper::displayUserRoleByEvent($event, Auth::user()) }})
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
