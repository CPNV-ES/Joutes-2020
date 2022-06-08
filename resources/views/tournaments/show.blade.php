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
                           title="Affichage écran géant">Affichage écran geant</a>
                    @endif
                    @if ( Auth::check() && (Auth::user()->role == "administrator"))
                        <a href="{{route('tournaments.export', $tournament->id)}}" class="greenBtn">Exporter en CSV les
                            équipes et participants</a>
                    @endif
                    <button type="button" class="btn btn-main"
                            onclick="location.href='{{ route('tournaments.edit', $tournament) }}'">
                        <i class="fa fa-edit fa-1x" aria-hidden="true"></i>
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
                                    <td class="clickable" data-id="{{$team->id}}">
                                        <a href="https://www.google.com" title="Complete cette équipe ">
                                            {{$team->name}}
                                        </a>
                                    </td>
                                @else
                                    <td data-id="{{$team->id}}">
                                        <a href="{{ route('teams.show', $team) }}"
                                           title="accéder à la page de l'équipe {{$team->name}}">
                                            {{$team->name}}
                                        </a>
                                    </td>
                                @endif
                                <td>{{$team->participants()->count()}}</td>

                                @if(!$team->isComplete() && $team->captain() )
                                    <td class="container pl-5">
                                        <div class="row align-content-center">
                                            <form action="{{ route('teams.update', $team) }}" method="post"
                                                  title="Complete cette équipe ">
                                                <input type="hidden" name="flag_name" value="completion">
                                                <input type="hidden" name="flag_value" value="1">
                                                <input type="hidden" name="flag_message"
                                                       value="est en attente de validation">
                                                @csrf
                                                @method('PUT')
                                                <button class="btn btn-main">
                                                    <i class="fa fa-check" aria-hidden="true"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                @else
                                    <td><i class="{{ $team->isComplete() ? 'fa fa-check' : 'fa fa-close' }}"
                                           aria-hidden="true"></i>
                                    </td>
                                @endif

                                @if($team->isComplete() && !$team->isValid())
                                    <td class="container pl-5">
                                        <div class="row align-content-center">
                                            <form action="{{ route('teams.update', $team) }}" method="post"
                                                  title="Valider cette équipe ">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="flag_name" value="validation">
                                                <input type="hidden" name="flag_value" value="1">
                                                <input type="hidden" name="flag_message" value="est validée">
                                                <button class="btn btn-main">
                                                    <i class="fa fa-check" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('teams.update', $team) }}" method="post"
                                                  title="Refuser cette équipe">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="flag_name" value="completion">
                                                <input type="hidden" name="flag_value" value="0">
                                                <input type="hidden" name="flag_message"
                                                       value="n'est pas validée et son status 'Complète' est annulé*">
                                                <button class="btn btn-danger">
                                                    <i class="fa fa-ban"
                                                       aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                @else
                                    <td><i class="{{ $team->isValid() ? 'fa fa-check' : 'fa fa-close' }}"
                                           aria-hidden="true"></i>
                                    </td>
                                @endif

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
                    <a href="{{ route('tournaments.teams.create', $tournament) }}" class="btn btn-main"
                       title="Ajouter une équipe au tournoi"><i class="fa fa-solid fa-plus fa-1x"
                                                                aria-hidden="true"></i></a>
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
                <a href="{{ route('courts.create', ['id_sport' => $tournament->sport->id]) }}" class="btn btn-main"
                   title="Créer un tournoi"><i class="fa fa-solid fa-plus fa-1x" aria-hidden="true"></i></a>
            </div>
        </div>

        <div class="row mt-5">

            <div class="col-11 ml-n2">
                <h2>Visualisation du tournoi
                    <button type="button" class="btn btn-main"
                            onclick="location.href='{{ route('tournaments.pools.create', $tournament) }}'">
                        <i class="fa fa-solid fa-plus fa-1x" aria-hidden="true"></i>
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
                        <div title="poule {{ $stage }}" class="pool">
                            <table id="" class="tableTeamList table table-bordered ">
                                <thead class="{{\App\Enums\PoolState::poolStateClassColor($pool->poolState)}}">
                                <tr>
                                    <th title="Teams In" class="teamlist">
                                        <a href="{{ route('tournaments.pools.show', [$tournament->id, $pool]) }}"> {{ $pool->poolName }} </a>
                                        <br><a
                                            class="poolHeader"> {{ \App\Enums\PoolState::poolStateName($pool->poolState) }}</a>
                                        @php
                                            $countPlayed = 0;
                                            $countPlanned = 0;
                                        @endphp
                                        @foreach($pool->games as $keyGame =>  $game)
                                            @if ($keyGame === 0)
                                                <br><a class="poolHeader">commence
                                                    à {{ Carbon\Carbon::parse($game->start_time)->format('H:i') }}</a>
                                            @endif
                                            @if($game->score_contender1 !== null && $game->score_contender2 !== null)
                                                @php
                                                    $countPlayed++;
                                                @endphp
                                            @else
                                                @php
                                                    $countPlanned++;
                                                @endphp
                                            @endif
                                        @endforeach

                                        @if( $pool->poolState == 2)
                                            <br><a class="poolHeader">jouée : {{ $countPlayed }}</a>
                                            <br><a class="poolHeader"> plannifiée : {{ $countPlanned }}</a>
                                        @endif
                                    </th>
                                    <th title="Teams Out" class="teamlist">Classement</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        {{--@php
                                            $allGamePlayed = false;
                                        @endphp
                                        @foreach($pool->games as $game)
                                            @if($game->score_contender1 === null && $game->score_contender2 === null)
                                                @php
                                                    $allGamePlayed = false;
                                                @endphp
                                            @else
                                                @if($pool->poolState == 2)
                                                    @php
                                                        $allGamePlayed = true;
                                                    @endphp
                                                @endif
                                            @endif
                                        @endforeach
                                        <table title="Teams In"
                                               class="table table-bordered teamlist tableStyle {{!$allGamePlayed ? $pool->poolState <= 1 ? "sortable" : "" : ""}}">
                                            @foreach ($pool->contenders->sortBy('rank_in_pool') as $contender)


                                                @foreach ($tournament->teams as $team)

                                                    @if ($team->name == \App\Helpers\ContenderHelper::contenderDisplayName($contender))
                                                        <tr>
                                                            <td title="Team" class="team colorBackground"
                                                                id="{{ $contender->previousId() }}">
                                                                <a>{{ \App\Helpers\ContenderHelper::contenderDisplayName($contender) }}</a>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach

                                            @endforeach

                                        </table>--}}

                                <tr>
                                    <td>
                                        {{--@php
                                            $allGamePlayed = false;
                                        @endphp
                                        @foreach($pool->games as $game)
                                            @if($game->score_contender1 === null && $game->score_contender2 === null)
                                                @php
                                                    $allGamePlayed = false;
                                                @endphp
                                            @else
                                                @if($pool->poolState == 2)
                                                    @php
                                                        $allGamePlayed = true;
                                                    @endphp
                                                @endif
                                            @endif
                                        @endforeach
                                        <table title="Teams In"
                                               class="table table-bordered teamlist tableStyle {{!$allGamePlayed ? $pool->poolState <= 1 ? "sortable" : "" : ""}}">
                                            @foreach ($pool->contenders->sortBy('rank_in_pool') as $contender)


                                                @foreach ($tournament->teams as $team)

                                                    @if ($team->name == \App\Helpers\ContenderHelper::contenderDisplayName($contender))
                                                        <tr>
                                                            <td title="Team" class="team colorBackground"
                                                                id="{{ $contender->previousId() }}">
                                                                <a>{{ \App\Helpers\ContenderHelper::contenderDisplayName($contender) }}</a>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach

                                            @endforeach

                                        </table>--}}
                                        <table title="Teams Out" class="table table-bordered teamlist tableStyle">
                                            @for ($i = 1; $i <= $pool->poolSize; $i++)
                                               @if($pool->contenders->isEmpty())
                                                    <tr>
                                                        <td title="Team" id="{{ $pool->id.'-'.$i }}">
                                                            <select>
                                                                <option> ---- </option>
                                                                @foreach ($tournament->teams as $team)

                                                                    <option value="{{ $team->id }}">{{ $team->name  }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </tr>
                                                @else
                                                    @php
                                                        $contender = $pool->contenders->sortBy('rank_in_pool')[$i-1];
                                                    @endphp
                                                    <tr>
                                                        <td title="Team" id="{{ $pool->id.'-'.$i }}">
                                                            <select>
                                                                <option> ---- </option>
                                                                @foreach ($tournament->teams as $team)

                                                                    <option value="{{ $team->id }}" {{$team->name == \App\Helpers\ContenderHelper::contenderDisplayName($contender)?'selected':''}}>{{ $team->name  }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endfor

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
                        </div>

                      {{--  @if(Auth::check())
                            @if(Auth::user()->role->slug == 'ADMIN')
                                @if(!$allGamePlayed)
                                    <a href="{{ route('tournaments.pools.close', $pool) }}"
                                       class="disabled btn btn-main closeButton">Terminer la pool</a>
                                @else
                                    <a href="{{ route('tournaments.pools.close', $pool) }}"
                                       class="btn btn-main closeButton">Terminer la pool</a>
                                @endif
                            @endif
                        @endif--}}
                    @endforeach


                </div>

            @else

                <div class="phase">
                    @foreach ($tournament->getPoolsOfStage($tournament->id, $stage) as $pool)

                        <div title="poule {{ $stage }}" class="pool">{{ $pool->name }}
                            <table id="" class="tableTeamList table table-bordered ">
                                <thead class="{{\App\Enums\PoolState::poolStateClassColor($pool->poolState)}}">
                                <tr>
                                    <th title="Teams In" class="teamlist">
                                        <a href="{{ route('tournaments.pools.show', [$tournament->id, $pool]) }}"> {{ $pool->poolName }} </a>
                                        <br><a
                                            class="poolHeader"> {{ \App\Enums\PoolState::poolStateName($pool->poolState) }}</a>
                                        @php
                                            $countPlayed = 0;
                                            $countPlanned = 0;
                                        @endphp
                                        @foreach($pool->games as $keyGame =>  $game)
                                            @if ($keyGame === 0)
                                                <br><a class="poolHeader">commence
                                                    à {{ Carbon\Carbon::parse($game->start_time)->format('H:i') }}</a>
                                            @endif
                                            @if($game->score_contender1 !== null && $game->score_contender2 !== null)
                                                @php
                                                    $countPlayed++;
                                                @endphp
                                            @else
                                                @php
                                                    $countPlanned++;
                                                @endphp
                                            @endif
                                        @endforeach

                                        @if( $pool->poolState == 2)
                                            <br><a class="poolHeader">jouée : {{ $countPlayed }}</a>
                                            <br><a class="poolHeader"> plannifiée : {{ $countPlanned }}</a>
                                        @endif
                                    </th>
                                    <th title="Teams Out" class="teamlist">Classement</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>@php
                                            $allGamePlayed = false;
                                        @endphp
                                        @foreach($pool->games as $game)
                                            @if($game->score_contender1 === null && $game->score_contender2 === null)
                                                @php
                                                    $allGamePlayed = false;
                                                @endphp
                                            @else
                                                @if($pool->poolState == 2)
                                                    @php
                                                        $allGamePlayed = true;
                                                    @endphp
                                                @endif
                                            @endif
                                        @endforeach
                                        <table id=""
                                               class="table table-bordered teamlist tableStyle {{!$allGamePlayed ? $pool->poolState <= 1 ? "sortable" : "" : ""}}">

                                            @php
                                                $teamName = "";
                                                $i = 1;
                                            @endphp

                                            {{-- Part of display for Visualisation to display name of team --}}

                                            @foreach ($pool->contenders->sortBy('rank_in_pool') as $contender)

                                                @if($contender->team_id == null)
                                                    <tr>
                                                        <td title="Team" class="team">
                                                            <a>{{ $contender->rank_in_pool }}
                                                                de {{ $contender->fromPool->poolName }}</a>
                                                        </td>
                                                    </tr>
                                                    @php $i++; @endphp
                                                @else
                                                    @foreach ($tournament->teams as $keyTeam => $team)

                                                        @if ($team->name == \App\Helpers\ContenderHelper::contenderDisplayName($contender))
                                                            @php $teamName = $team->name @endphp

                                                            <tr>
                                                                <td title="Team" class="team colorBackground"
                                                                    data-previous="{{ $contender->previousId() }}">
                                                                    <a>{{ \App\Helpers\ContenderHelper::contenderDisplayName($contender) }}</a>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
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
                                                @endif
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
                        </div>
                        @if(Auth::check())
                            @if(Auth::user()->role->slug == 'ADMIN')
                                @if(!$allGamePlayed)
                                    <a href="{{ route('tournaments.pools.close', $pool) }}"
                                       class="disabled btn btn-main closeButton">Terminer la pool</a>
                                @else
                                    <a href="{{ route('tournaments.pools.close', $pool) }}"
                                       class="btn btn-main closeButton">Terminer la pool</a>
                                @endif
                            @endif
                        @endif
                    @endforeach
                </div>

    @endif
    @endforeach
    </body>
    <script src="{{ asset('js/tournamentView.js') }}"></script>
@stop
