<!-- @author Yvann -->
@extends('layout')

@section('content')
	<div class="container boxList">
		<h1>
			Evénements
			@if(Auth::check())
				@if(Auth::user()->role == 'administrator')
					<a href="{{route('events.create')}}" class="greenBtn" title="Créer un événement">Ajouter</i></a>
				@endif
			@endif
		</h1>

		<input type="search" placeholder="Recherche" class="search form-control">

		<div class="row searchIn">

			@foreach ($events as $event)
				<div class="col-md-4 hideSearch">
					<div class="box">
						<div class="imgBox">
							<a href="{{route('events.tournaments.index', $event->id)}}" title="Voir l'événement">
								<!-- <img src="{{ url('event_img/'.$event->img) }}" alt="Image de l'événement">
								<div class="title name"> {{$event->name}} </div>
							</a>
						</div>

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
			@endforeach
			@if(count($events) == 0)
				<div class="col-md-12">Aucun événement pour l'instant...</div>
			@endif

		</div>

	</div>
@stop
