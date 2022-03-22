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
                        @endif
                    </x-event>
                @endforeach
            </div>
        @empty
            <h1>Aucun événement prévu</h1>
        @endforelse
    </div>
@stop
