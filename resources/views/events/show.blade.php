@extends('layout')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-1 ml-n5">
                <a href="{{ route('events.index') }}"><i class="fa fa-4x fa-arrow-circle-left return fa-return growIcon"
                        aria-hidden="true"></i></a>
            </div>

            <div class="col-11 ml-n2">
                <h1>
                    Tournois de l'évenement {{ $event->name }}

                    @if (Auth::check())
                        @if (Auth::user()->role->slug == 'ADMIN')
                            <button type="button" class="btn btn-main"
                                onclick="location.href='{{ route('events.tournaments.create', $event->id) }}'">
                                <i class="fa fa-solid fa-plus fa-1x" aria-hidden="true"></i>
                            </button>
                            @if ($event->eventState < 3)
                                <button type="button" class="btn btn-main" data-toggle="modal"
                                    data-target="#stageEventModal">État suivant
                                    : {{ Helper::eventStateName($event->eventState + 1) }} </button>
                            @endif
                        @endif
                        @if (Gate::allows('isPart'))
                            @if (Helper::EventRoleUser(Auth::user(), $event))
                                <h4>
                                    <a href="#" class="badge badge-success">Mon programme</a>
                                    <span class="badge badge-info">Déjà Inscript
                                        ({{ Helper::EventRoleUser(Auth::user(), $event)->role->name }})
                                    </span>
                                </h4>
                            @else
                                @if ($event->eventState == \App\Enums\EventState::Register)
                                    <a href="{{ route('events.eventRoleUsers.create', [$event]) }}"
                                        class="btn btn-main btn-lg active" role="button" aria-pressed="true">S'insrire à
                                        l'évenement</a>
                                @endif
                            @endif
                        @endif
                    @endif
                </h1>
            </div>
            <div class="col-11 ml-n2 inline mb-3 flex flex-row inline">
                @if (Auth::check())
                    @if (Gate::allows('isAdmin'))
                        <h3>État : {{ Helper::eventStateName($event->eventState) }}</h3>

                        <form action="#" method="get">
                            <button type="button" class="btn btn-main">Créer une équipe
                            </button>
                        </form>
                    @endif
                @endif
            </div>

        </div>

        <div class="row ml-4">
            @include('tournaments.list')
        </div>
    </div>

    <x-confirm trigger="stageEventModal" route="events.update" :parameters="[$event]">
    </x-confirm>

@stop
