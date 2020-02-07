<!-- @author Yvann -->
@extends('layout')

@section('content')
	<div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <h1>
                    Evénements
                    @if(Auth::check())
                        @if(Auth::user()->role == 'administrator')
                            <a href="{{route('events.create')}}" class="greenBtn" title="Créer un événement">Ajouter</i></a>
                        @endif
                    @endif
                </h1>

                <hr>
            </div>
        </div>

		<div class="row ml-4">

			@foreach ($events as $event)
                <a href="{{route('events.tournaments.index', $event->id)}}" title="Voir l'événement">
                    <div class="card">
                        @if($event->img != null)
                            <img class="card-img" src="{{ asset('images/joutes.jpg') }}" alt="Image de l'événement">
                        @else
                            <!-- Get uploaded image -->
                        @endif

                        <div class="card-body">
                            <h5 class="card-title">{{$event->name}} </h5>

                            @if(Auth::check())
                                @if(Auth::user()->role == 'administrator')
                                    <div class="infos">
                                        <a href="{{route('events.edit', $event->id)}}" title="Éditer le événement" class="edit"><i class="fa fa-pencil fa-lg action" aria-hidden="true"></i></a>

                                        {{-- {{ Form::open(array('url' => route('events.destroy', $event->id), 'method' => 'delete')) }}
                                            <button type="button" class="button-delete" data-name="{{ $event->name }}" data-type="tournament">
                                                <i class="fa fa-trash-o fa-lg action" aria-hidden="true"></i>
                                            </button>
                                        {{ Form::close() }} --}}
                                    </div>
                                @endif
                            @endif

                        </div>
                    </div>
                </a>

			@endforeach
			@if(count($events) == 0)
				<div class="col-md-12">Aucun événement pour l'instant...</div>
			@endif

		</div>

	</div>
@stop
