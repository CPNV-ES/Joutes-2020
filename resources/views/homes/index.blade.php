<!-- @author Yvann -->
@extends('layout')

@section('content')
    <div class="container">



        @forelse ($states as $state => $events)
            <div class="row mb-4">
                <div class="col-12">
                    <h1>
                        Evénements {{ \App\Enums\EventState::eventStateName($state) }}
                    </h1>
                    <hr>
                </div>
            </div>
            @foreach ($events as $event)
                <div class="row ml-4">
                    <a href="{{ route('events.show', $event->id) }}" title="Voir l'événement">
                        <div class="card">
                            @if ($event->img != null)
                                <img class="card-img" src="images/joutes/{{ $event->img }}"
                                    alt="Image de l'événement">
                            @else
                                <!-- Get uploaded image -->
                            @endif

                            <div class="card-body">
                                <h5 class="card-title">{{ $event->name }}</h5>
                                @if (Auth::check())
                                    @if (Auth::user()->role == 'administrator')
                                        <div class="infos">
                                            <a href="{{ route('events.edit', $event->id) }}" title="Éditer le événement"
                                                class="edit"><i class="fa fa-pencil fa-lg action"
                                                    aria-hidden="true"></i></a>
                                        </div>
                                    @endif
                                @endif
                                <span class="badge badge-light">
                                    {{ \App\Enums\EventState::eventStateName($event->eventState) }}
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

        @empty
            <h1>Aucun événement prévu</h1>
        @endforelse



    </div>
@stop
