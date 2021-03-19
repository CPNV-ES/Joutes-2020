@extends('layout')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-1 ml-n5">
                <a href="{{ route('events.show', $tournament->event) }}"><i
                        class="fa fa-4x fa-arrow-circle-left return fa-return growIcon" aria-hidden="true"></i></a>
            </div>

            <div class="col-11 ml-n2">
                <h1 class="tournamentName">
                    {{ $tournament->name }}
                    @if (Auth::check() && (Auth::user()->role == 'administrator' || Auth::user()->role == 'writer'))
                        <a href="{{ route('tournaments.schedule.index', $tournament->id) }}" class="greenBtn big-screen"
                           title="Affichage écran géant">Affichage écran geant</i></a>
                    @endif
                    @if ( Auth::check() && (Auth::user()->role == "administrator"))
                        <a href="{{route('tournaments.export', $tournament->id)}}" class="greenBtn">Exporter en CSV les
                            équipes et participants</a>
                    @endif
                    <button type="button" class="btn btn-main"
                            onclick="location.href='{{ route('tournaments.edit', $tournament) }}'">
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
                                <td><i class="{{ $team->isComplete() ? 'fa fa-check' : 'fa fa-close' }}"
                                       aria-hidden="true"></i></td>
                                <td><i class="{{ $team->isValid() ? 'fa fa-check' : 'fa fa-close' }}"
                                       aria-hidden="true"></i></td>
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
                    <a href="{{ route('tournaments.teams.create', $tournament) }}" class="greenBtn"
                       title="Ajouter une équipe au tournoi">Ajouter</i></a>
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
                <a href="{{ route('courts.create', ['id_sport' => $tournament->sport->id]) }}" class="greenBtn"
                   title="Créer un tournoi">Ajouter</i></a>
            </div>
        </div>

        <div class="row mt-5">

            <div class="col-11 ml-n2">
                <h2>Visualisation du tournoi
                    <button type="button" class="btn btn-main"
                            onclick="location.href='{{ route('tournaments.pools.create', $tournament) }}'">
                        Ajouter une poule
                    </button>
                </h2>
                <hr>
            </div>
        </div>

    </div>

    <body>


    <div id="tournament" title="tournament" class="tournament">
        @foreach ($tournament->getStages() as $key => $stage)
            @if($key === 0)
                <div class="phase">
                    @foreach ($tournament->getPoolsOfStage($tournament->id, $stage) as $pool)
                        <div title="poule {{ $stage }}" class="pool">{{ $pool->name }}
                            <table id="" class="tableTeamList table table-bordered ">
                                <thead>
                                <tr>
                                    <th title="Teams In" class="teamlist"><a
                                            href="{{ route('tournaments.pools.show', [$tournament->id, $pool]) }}"> {{ $pool->poolName }} </a>
                                    </th>
                                    <th title="Teams Out" class="teamlist">Classement</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <table title="Teams In" class="table table-bordered teamlist tableStyle">

                                            @foreach ($pool->contenders as $contender)
                                                @if($pool->games)

                                                @endif
                                                @foreach ($tournament->teams as $team)

                                                    @if ($team->name == \App\Helpers\ContenderHelper::contenderDisplayName($contender))
                                                        <tr>
                                                            <td title="Team" class="team colorBackground"
                                                                id="{{ $contender->previousId() }}">{{ \App\Helpers\ContenderHelper::contenderDisplayName($contender) }}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endforeach

                                        </table>
                                    </td>
                                    <td>
                                        <table title="Teams Out" class="table table-bordered teamlist tableStyle">
                                            @for ($i = 1; $i <= $pool->poolSize; $i++)
                                                <tr>
                                                    <td title="Team" class="team"
                                                        id="{{ $pool->id.'-'.$i }}">{{ $i }}</td>
                                                </tr>
                                            @endfor
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            @foreach($pool->games as $keyGame =>  $game)
                                @if ($keyGame === 0)
                                    @if($game->score_contender1 === null or $game->score_contender2 === null and $pool->pool_states->slug == "PROGR" )
                                        <a href="{{ route('tournaments.pools.close', $pool) }}"
                                           class="disabled btn btn-main closeButton">Terminer la pool</a>
                                    @else
                                        <a href="{{ route('tournaments.pools.close', $pool) }}"
                                           class="btn btn-main closeButton">Terminer la pool</a>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                </div>

            @else

                <div class="phase">
                    @foreach ($tournament->getPoolsOfStage($tournament->id, $stage) as $pool)

                        <div title="poule {{ $stage }}" class="pool">{{ $pool->name }}
                            <table id="" class="tableTeamList table table-bordered ">
                                <thead>
                                <tr>
                                    <th title="Teams In" class="teamlist"><a
                                            href="{{ route('tournaments.pools.show', [$tournament->id, $pool]) }}"> {{ $pool->poolName }} </a>
                                    </th>
                                    <th title="Teams Out" class="teamlist">Classement</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <table id="" class="table table-bordered teamlist tableStyle">
                                            @php $teamName = ""; @endphp

                                            {{-- Part of display for Visualisation to display name of team --}}
                                            @foreach ($pool->contenders as $contender)
                                                @foreach ($tournament->teams as $keyTeam => $team)
                                                    @if ($team->name == \App\Helpers\ContenderHelper::contenderDisplayName($contender))
                                                        @php $teamName = $team->name @endphp

                                                        <tr>
                                                            <td title="Team" class="team colorBackground"
                                                                data-previous="{{ $contender->previousId() }}">{{ \App\Helpers\ContenderHelper::contenderDisplayName($contender) }}</td>
                                                        </tr>

                                                    @endif
                                                @endforeach
                                                {{-- Part of the display for Visualisation when no team name is displayed --}}
                                                @foreach ($tournament->teams as $keyTeam => $team)
                                                    @if ($team->name != \App\Helpers\ContenderHelper::contenderDisplayName($contender))
                                                        @if (\App\Helpers\ContenderHelper::contenderDisplayName($contender) != $teamName)
                                                            @if ($keyTeam === 0)

                                                                <tr>
                                                                    <td title="Team" class="team "
                                                                        data-previous="{{ $contender->previousId() }}">{{ \App\Helpers\ContenderHelper::contenderDisplayName($contender) }}</td>
                                                                </tr>
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @endforeach

                                        </table>
                                    </td>
                                    <td>
                                        <table id="" class="table table-bordered teamlist tableStyle">
                                            @for ($i = 1; $i <= $pool->poolSize; $i++)
                                                <tr>
                                                    <td title="Team" class="rank teamlist"
                                                        id="{{ $pool->id.'-'.$i }}">{{ $i }}</td>
                                                </tr>
                                            @endfor
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            @foreach($pool->games as $keyGame =>  $game)
                                @if ($keyGame === 0)
                                    @if($game->score_contender1 === null or $game->score_contender2 === null or $pool->pool_states->slug == "PROGR" )
                                        <a href="{{ route('tournaments.pools.close', $pool) }}"
                                           class="disabled btn btn-main closeButton">Terminer la pool</a>
                                    @else
                                        <a href="{{ route('tournaments.pools.close', $pool) }}"
                                           class="btn btn-main closeButton">Terminer la pool</a>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                </div>
            @endif

        @endforeach
    </div>


    </body>
    <script src="{{ asset('js/tournamentView.js') }}"></script>
@stop
