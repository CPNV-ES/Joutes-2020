
@extends('layout')

@section('content')
	<div class="container">

        <div class="row">
            <div class="col-1 ml-n5">
                <a href="{{ route('events.index') }}"><i class="fa fa-4x fa-arrow-circle-left return fa-return growIcon" aria-hidden="true"></i></a>
            </div>

            <div class="col-11 ml-n2">
                @if ($tournamentFromEvent)
                    <h1>
                        Tournois de l'évenement {{ $event->name }}
                        @if(Auth::check() && $tournamentFromEvent)
                            @if(Auth::user()->role == 'administrator')
                                <a href="{{route('events.tournaments.create', $event->id)}}" class="greenBtn" title="Créer un tournoi">Ajouter</i></a>
                            @endif
                        @endif
                    </h1>
                @else
                    <h1>Tournois</h1>
                @endif

                <hr>

               <input type="search" placeholder="Recherche" class="search form-control">
            </div>

        </div>

		<div class="row">

            @foreach ($tournaments as $tournament)

                <a href="{{route('tournaments.show', $tournament->id)}}" title="Voir le tournoi">
                    <div class="card">
                        @if($tournament->img != null)
                            <img class="card-img" src="{{ asset('images/tournament-default.png') }}" alt="Image de l'événement">
                        @else
                            <!-- Get uploaded image -->
                        @endif

                        <div class="card-body">
                            <h5 class="card-title">{{$tournament->name}} </h5>

                            <div class="card-text">
                                <div class="sport"> {{ $tournament->sport->name }} </div>
                                <div class="date"> {{$tournament->start_date->format('d.m.Y')}} | {{$tournament->start_date->format('H:i')}}-{{$tournament->end_date->format('H:i')}}</div>

                                @if(Auth::check())
                                    @if(Auth::user()->role == 'administrator')
                                        <a href="{{route('tournaments.edit', $tournament->id)}}" title="Éditer le tournoi" class="edit"><i class="fa fa-lg fa-pencil action" aria-hidden="true"></i></a>
                                        <!--{{ Form::open(array('url' => route('tournaments.destroy', $tournament->id), 'method' => 'delete')) }}
                                            <button type="button" class="button-delete" data-name="{{ $tournament->name }}" data-type="tournament">
                                                <i class="fa fa-lg fa-trash-o action" aria-hidden="true"></i>
                                            </button>
                                        {{ Form::close() }}-->
                                    @endif
                                @endif

                            </div>

                        </div>
                    </div>
                </a>
			@endforeach
			@if(count($tournaments) == 0)
				<div class="col-md-12">Aucun tournoi pour l'instant...</div>
			@endif
		</div>

	</div>
@stop
