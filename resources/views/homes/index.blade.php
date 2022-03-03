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
            <div class="row">
                @foreach ($events as $event)
                    <x-event :event="$event">
                        @if (Auth::check() && $event->user(Auth::user())->first())
                            <span class="badge badge-success"> Inscrit
                                ({{ \App\Engagement::find($event->user(Auth::user())->first()->pivot->engagement_id)->name }})
                            </span>
                        @endif
                    </x-event>
                @endforeach
            </div>

        @empty
            <h1>Aucun événement prévu</h1>
        @endforelse



    </div>
@stop
