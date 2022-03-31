<!-- @author Yvann -->
@extends('layout')

@section('content')
    <div class="container">
        @forelse ($states as $state => $events)
            <div class="row mb-4">
                <div class="col-12">
                    <h1>
                        Evénements {{ Helper::eventStateName($state) }}
                    </h1>
                    <hr>
                </div>
            </div>
            <div class="row ">
                @foreach ($events as $event)
                    <x-event :event="$event">
                        @if (Gate::allows('isPart') && Helper::eventRoleUser(Auth::user(), $event))
                            <span class="badge badge-success"> Inscrit
                                ({{ Helper::EventRoleUser(Auth::user(), $event)->role->name }})
                            </span>
                            @if (Gate::allows('isOrganizer'))
                                <a href="{{ route('events.edit', $event->id) }}" class="btn btn-main"
                                    title="Modifier l'événement">
                                    <i class="fa fa-solid fa-edit fa-1x" aria-hidden="true"></i>
                                </a>
                            @endif
                        @endif
                    </x-event>
                @endforeach
            </div>
        @empty
            <h1>Aucun événement prévu</h1>
        @endforelse
    </div>
@stop
