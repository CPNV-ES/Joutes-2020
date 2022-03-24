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
                    @if (Gate::allows('isPart') && Helper::EventRoleUser(Auth::user(), $event))
                        <span class="badge badge-success"> Inscrit
                            ({{ Helper::EventRoleUser(Auth::user(), $event)->role->name }})
                        </span>
                    @endif
                    <span class="badge badge-light">
                        {{ Helper::eventStateName($event->eventState) }}
                    </span>
                </x-event>
            @endforeach
            @if (count($events) == 0)
                <div class="col-md-12">Aucun événement pour l'instant...</div>
            @endif
        </div>
    </div>
@stop
