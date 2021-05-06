@extends('layout')

@section('content')
	<div class="container">

        <div class="row">
            <div class="col-1 ml-n5">
                <a href="{{ route('events.index') }}"><i class="fa fa-4x fa-arrow-circle-left return fa-return growIcon" aria-hidden="true"></i></a>
            </div>

            <div class="col-11 ml-n2">
                <h1>
                    Tournois de l'évenement {{ $event->name }}
                    @if(Auth::check())
                        @if(Auth::user()->role->slug =='ADMIN')
                    <button type="button" class="btn btn-main" onclick="location.href='{{ route('events.tournaments.create', $event->id) }}'">Créer un tournoi</button>

                        @endif
                    @endif
                </h1>

                <hr>
            </div>

        </div>

		<div class="row ml-4">
            @include('tournaments.list')
		</div>
	</div>
@stop
