<!-- @author Yvann -->
@extends('layout')

@section('content')
    <div class="container">
        @if(Auth::user())
        <h1>Bonjour {{Auth::user()->first_name}},</h1>
        @foreach ($userEvents as $userEvent)
            @if ($userEvent === 0)
                <div class="row mb-4">
                    <div class="col-12">
                        <h2>Evénements à venir</h2>
                        <hr>
                        @foreach($events as $event)
                            <x-event :event="$event">
                                @if (Gate::allows('isPart') && Helper::eventRoleUser(Auth::user(), $event))
                                    <span class="badge badge-success"> Inscrit
                                ({{ Helper::EventRoleUser(Auth::user(), $event)->role->name }})
                            </span>
                                @endif
                            </x-event>
                        @endforeach
                    </div>
                </div>
            @elseif($userEvent === 1)
                <div class="row mb-4">
                    <div class="col-12">
                        <h2>Inscription possible</h2>
                        <hr>
                        <x-event :event="$event">
                            @if (Gate::allows('isPart') && Helper::eventRoleUser(Auth::user(), $event))
                                <span class="badge badge-success"> Inscrit
                                ({{ Helper::EventRoleUser(Auth::user(), $event)->role->name }})
                            </span>
                            @endif
                        </x-event>
                    </div>
                </div>
            @elseif($userEvent === 2)
                <div class="row mb-4">
                    <div class="col-12">
                        <h2>Mes événements en cours</h2>
                        <hr>
                        <x-event :event="$event">
                            @if (Gate::allows('isPart') && Helper::eventRoleUser(Auth::user(), $event))
                                <span class="badge badge-success"> Inscrit
                                ({{ Helper::EventRoleUser(Auth::user(), $event)->role->name }})
                            </span>
                            @endif
                        </x-event>
                    </div>
                </div>
            @elseif($userEvent === 3)
                <div class="row mb-4">
                    <div class="col-12">
                        <h2>Mes événements terminés</h2>
                        <hr>
                    </div>
                    @endif
                    @endforeach
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
            @endif
                <h2>Veuillez vous connecter</h2>
    </div>
@stop
