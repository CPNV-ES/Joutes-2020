
@extends('layout')

@section('content')
	<div class="container">

        <div class="row">
            <div class="col-1 ml-n5">
                <a href="{{ route('events.show', $tournament->event) }}"><i class="fa fa-4x fa-arrow-circle-left return fa-return growIcon" aria-hidden="true"></i></a>
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
                    <button type="button" class="btn btn-main" onclick="location.href='{{ route('tournaments.edit', $tournament) }}'">
                        Éditer le tournoi
                    </button>
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
                @if(count($tournament->teams) < $tournament->max_teams)
                <a href="{{ route('tournaments.teams.create', $tournament) }}" class="greenBtn" title="Ajouter une équipe au tournoi">Ajouter</i></a>
                @endif
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

            <div class="col-11 ml-n2">
                <h2>Visualisation du tournoi
                    <button type="button" class="btn btn-main" onclick="location.href='{{ route('tournaments.pools.create', $tournament) }}'">
                      Ajouter une poule
                    </button>
                </h2>
                <hr>
            </div>
        </div>

        </div>

<body>
        {{--Tournoi<br>
         <div title="Teams" class="teamlist">Equipes
            {{-- <div title="Team" class="team" id="team0_01">Team</div>
            @foreach ($tournament->teams as $team)
                <div title="Team" class="team" id="{{ $team->id }}">{{ $team->name }}</div>
            @endforeach
        </div> --}}


        <div id="tournament" title="tournament" class="tournament">
            Tournoi<br>
            <div title="Teams" class="teamlist">Equipes
                {{-- <div title="Team" class="team" id="team0_01">Team</div> --}}
                @foreach ($tournament->teams as $team)
                    <div title="Team" class="team" id="{{ $team->id }}">{{ $team->name }}</div>
                @endforeach
            </div>

            @foreach ($tournament->getStages() as $stage)
                Phase {{ $stage }}

                <div>
                    @foreach ($tournament->getPoolsOfStage($tournament->id, $stage) as $pool)
                        <div title="poule {{ $stage }}" class="pool">{{ $pool->name }}
                            <div title="Teams In" class="teamlist"><a href="{{ route('tournaments.pools.show', [$tournament->id, $pool]) }}">{{ $pool->poolName }}</a>
                                @foreach ($pool->contenders as $contender)
                                    <div title="Team" class="team" data-previous="{{ $contender->previousId() }}">{{ \App\Helpers\ContenderHelper::contenderDisplayName($contender) }}</div>
                                @endforeach
                            </div>
                            <div title="Teams Out" class="teamlist">Classement
                                @for ($i = 1; $i <= $pool->poolSize; $i++)
                                    <div title="Team" class="team" id="{{ $pool->id.'-'.$i }}">{{ $i }}</div>
                                @endfor
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>



    <div  id="tournament" title="tournament" class="tournament">
        @foreach ($tournament->getStages() as $key => $stage)

            <div class="phase">
                Phase {{ $stage }}

                @foreach ($tournament->getPoolsOfStage($tournament->id, $stage) as $pool)
            <table id="" class="tableTeamList table table-bordered ">
                <thead>
                    <tr>
                        <th title="Teams In" class="teamlist"><a href="{{ route('tournaments.pools.show', [$tournament->id, $pool]) }}"> {{ $pool->poolName }} </a> </th>
                        <th title="Teams Out" class="teamlist">Classement</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <table id="" class="table table-bordered table-hover">

                                 @foreach ($pool->contenders as $contender)
                                <tr title="Team" class="team"
                                    @if($key === 0) id="{{ $contender->previousId() }}" @else data-previous="{{ $contender->previousId() }}" @endif>
                                    <td>
                                    {{ \App\Helpers\ContenderHelper::contenderDisplayName($contender) }}
                                    </td>
                                </tr>
                                @endforeach

                            </table>
                        </td>
                        <td>
                            <table id="" class="table table-bordered">
                                @for ($i = 1; $i <= $pool->poolSize; $i++)
                                    <tr title="Team" class="rank" id="{{ $pool->id.'-'.$i }}">
                                        <td>
                                    {{ $i }}
                                        </td>
                                    </tr>
                                @endfor
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
                @endforeach
        </div>

        @endforeach
    </div>
</body>
<script src="{{ asset('js/tournamentView.js') }}"></script>
@stop
