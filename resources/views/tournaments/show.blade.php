
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


            

            <!-- Stages and pools -->
            {{-- @if (sizeof($tournament->pools) > 0)

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
                                                @foreach ($pools as $pool)
                                                        <tbody>
                                                            @if ($pool->stage == $i)
                                                                <tr>
                                                                    <td data-id="{{$pool->id}}" class="clickable">
                                                                    <a href="{{ route('tournaments.pools.show', [$tournament, $pool]) }}">
                                                                            {{$pool->poolName}}
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        </tbody>
                                                @endforeach
                                    </table>
                                </td>
                            @endfor
                        </tr>


                    </tbody>
                </table>
            @else
                Indisponible pour le moment ...
            @endif --}}



        </div>

        <script>
            var canvas
            var ctx
            /*
                Principe:
                - Chaque poule contient deux listes d'équipes: les entrantes et les sortantes (classement)
                - On donne un id aux équipes sortantes et aux équipes de départ
                - Chaque équipe 'entrante' a un champ 'data-previous' qui contient l'id d'une équipe sortante
                - Au survol d'une équipe avec la souris, on lit le previous et on la met en évidence avec une classe 'highlight'
             */
            document.addEventListener('DOMContentLoaded', function () {
                Array.from(document.getElementsByClassName("team")).forEach(function (element) {
                    element.addEventListener('mouseover', function (evt) {
                        previous = document.getElementById(evt.target.dataset.previous)
                        previous.classList.add('highlight')
                        evt.target.classList.add('highlight')
                        connect(previous.getBoundingClientRect(),evt.target.getBoundingClientRect())
                    });
                    element.addEventListener('mouseout', function (evt) {
                        previous = document.getElementById(evt.target.dataset.previous)
                        previous.classList.remove('highlight')
                        evt.target.classList.remove('highlight')
                        ctx.clearRect(0, 0, canvas.width, canvas.height);
                    });
                });
    
                canvas = document.getElementById("canvas");
                ctx = canvas.getContext("2d");
                area = tournament.getBoundingClientRect()
                canvas.width = area.width
                canvas.height = area.height
            })
    
            function connect(r1,r2)
            {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                ctx.beginPath();
                ctx.moveTo(r1.x + r1.width/2, r1.y+r1.height/2);
                ctx.lineTo(r2.x + r2.width/2, r2.y+r2.height/2);
                ctx.stroke();
            }
    
        </script>
        <style>
            .highlight {
                background-color: pink;
            }
    
            .tournament {
                border: solid 3px blue;
                padding: 2px;
                margin: 2px;
                display: flex;
                flex-direction: row;
            }
    
            .phase {
                border: solid 2px red;
                padding: 2px;
                margin: 2px;
                display: flex;
                flex-direction: column;
            }
    
            .pool {
                border: solid 1px green;
                padding: 2px;
                margin: 2px;
                display: flex;
                flex-direction: row;
            }
    
            .teamlist {
                border: solid 1px black;
                padding: 2px;
                margin: 2px;
                display: flex;
                flex-direction: column;
            }
    
            .team {
                border: solid 1px gray;
                padding: 2px;
                margin: 2px;
            }
    
            #canvas {
                position: absolute;
                border: 1px solid red;
                z-index: -1;
            }
        </style>

<body>
    <canvas id="canvas" width=300 height=300></canvas>
    <div id="tournament" title="tournament" class="tournament">
        Tournoi<br>
        <div title="Teams" class="teamlist">Equipes
            {{-- <div title="Team" class="team" id="team0_01">Team</div> --}}
            @foreach ($tournament->teams as $team)
                <div title="Team" class="team" id="{{ $team->id }}">{{ $team->name }}</div>
            @endforeach
        </div>

        @for ($i = 1; $i <= $maxStage; $i++)
            Phase {{ $i }}

            @foreach ($pools as $pool)
                @if($pool->stage == $i)
                    <div title="poule {{ $pool->stage }}_{{ $i }}" class="pool">{{ $pool->name }}
                        <div title="Teams In" class="teamlist">In
                            @foreach ($tournament->teams as $team)
                                @foreach ($pool->contenders as $contender)
                                    @if($contender->team_id == $team->id)
                                        <div title="Team" class="team" data-previous="{{ $team->id }}">{{ $team->name }}</div>
                                    @endif
                                @endforeach
                            @endforeach
                        </div>
                        <div title="Teams Out" class="teamlist">Out
                            <div title="Team" class="team" id="team1_01">Team</div>
                            <div title="Team" class="team" id="team1_09">Team</div>
                            <div title="Team" class="team" id="team1_17">Team</div>
                            <div title="Team" class="team" id="team1_25">Team</div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endfor
    </div>
</body>
@stop
