
@extends('layout')

@section('content')
	<div class="container">

        <div class="row">
            <div class="col-1 ml-n5">
                <a href="{{ route('events.index') }}"><i class="fa fa-4x fa-arrow-circle-left return fa-return growIcon" aria-hidden="true"></i></a>
            </div>

            <div class="col-11 ml-n2">
                <h1 class="tournamentName">
                    {{ $tournament->name }}
                    @if (Auth::check() && (Auth::user()->role == 'administrator' || Auth::user()->role == 'writer'))
                        <a href="{{ route('tournaments.schedule.index', $tournament->id) }}" class="greenBtn big-screen" title="Affichage écran géant">Affichage écran geant</i></a>
                    @endif
                    @if ( Auth::check() && (Auth::user()->role == "administrator"))
                        <a href="{{route('tournaments.export', $tournament->id)}}" class="greenBtn">Exporter en CSV les équipes et participants</a>
                    @endif

                </h1>

                <hr>

            </div>

        </div>


		<div class="right">
			<div>
				@if(isset($tournament->sport))
					<strong>Sport :</strong> {{ $tournament->sport->name }}
				@else
					<strong>Sport :</strong> Aucun, veuillez en choisir un.
				@endif
			</div>

			<div><strong>Début du tournoi :</strong> {{ $tournament->start_date->format('d.m.Y à H:i') }}</div>
		</div>

		<div class="row">
			<div class="col-lg-6">
				<table id="" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Liste des équipes participantes</th>
							<th>Nb participants</th>
							<th>Complet</th>
							<th>Valide</th>
						</tr>
					</thead>
					<tbody>
						@if(count($tournament->teams) > 0)
					  		@foreach ($tournament->teams as $team)
					  			<tr>
					  				@if(Auth::check() && Auth::user()->role == 'administrator')
   										<td class="clickable" data-id="{{$team->id}}">{{$team->name}}</td>
									@else
										<td data-id="{{$team->id}}">{{$team->name}}</td>
									@endif
									<td>{{$team->participants()->count()}}</td>
        							<td><i class="{{ $team->isComplete() ? 'fa fa-check' : 'fa fa-close' }}" aria-hidden="true"></i></td>
        							<td><i class="{{ $team->isValid() ? 'fa fa-check' : 'fa fa-close' }}" aria-hidden="true"></i></td>
								</tr>
							@endforeach
						@else
							<tr>
								<td>Aucune équipe pour l'instant ...</td>
							</tr>
					  	@endif
					</tbody>
				</table>
			</div>

			<div class="col-lg-6">
				<table id="" class="table table-striped table-bordered translate" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Liste des terrains</th>
						</tr>
					</thead>
					<tbody>
						@if(count($tournament->sport->courts) > 0)
							@foreach ($tournament->sport->courts as $court)
					  		<tr>
								<td class="clickable">{{$court->name}}</td>
							</tr>
							@endforeach
						@else
							<tr>
								<td>Aucun terrain pour l'instant ...</td>
							</tr>
						@endif
					</tbody>
				</table>
				<a href="{{ route('courts.create', ['id_sport' => $tournament->sport->id]) }}" class="greenBtn" title="Créer un tournoi">Ajouter</i></a>
			</div>
        </div>

        <div class="row mt-5">

            <h2>Visualisation du tournoi</h2>

            <!-- Stages and pools -->
            @if (sizeof($tournament->pools) > 0)

                <table class="table">
                    <thead>
                        <tr>
                            <th class="sizedTh"></th>
                            @for ($i = 1; $i <= $maxStage; $i++)

                                <th class="nav-item">
                                    Phase {{$i}}
                                </th>

                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th class="verticalText"><span>Poules</span></th>
                            @for ($i = 1; $i <= $maxStage; $i++)
                                <td class="noPadding">
                                    <table id="pools-table" class="table-hover table-striped table-bordered" width="100%" data-tournament="{{$tournament->id}}">
                                        <tbody>
                                            @foreach ($pools as $pool)
                                                @if ($pool->stage == $i)
                                                <tr>
                                                    <td data-id="{{$pool->id}}" class="clickable">{{$pool->poolName}}</td>
                                                </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                            @endfor
                        </tr>


                    </tbody>
                </table>
            @else
                Indisponible pour le moment ...
            @endif

        </div>

@stop
