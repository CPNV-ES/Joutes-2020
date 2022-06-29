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
                    @if (Auth::check() && Auth::user()->role == 'administrator')
                        <a href="{{ route('tournaments.export', $tournament->id) }}" class="greenBtn">Exporter en
                            CSV
                            les
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
                @if (isset($tournament->sport))
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
                        @if (count($tournament->teams) > 0)
                            @foreach ($tournament->teams as $team)
                                <tr>
                                    @if (Auth::check() && Auth::user()->role == 'administrator')
                                        <td class="clickable" data-id="{{ $team->id }}">
                                            <a href="https://www.google.com" title="Complete cette équipe ">
                                                {{ $team->name }}
                                            </a>
                                        </td>
                                    @else
                                        <td data-id="{{ $team->id }}">
                                            <a href="{{ route('teams.show', $team) }}"
                                                title="accéder à la page de l'équipe {{ $team->name }}">
                                                {{ $team->name }}
                                            </a>
                                        </td>
                                    @endif
                                    <td>{{ $team->participants()->count() }}</td>

                                    @if (!$team->isComplete() && $team->captain())
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
                                                    <i class="fa fa-ban" aria-hidden="true"></i>
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
                @if (count($tournament->teams) < $tournament->max_teams)
                    <a href="{{ route('tournaments.teams.create', $tournament) }}" class="btn btn-main"
                        title="Ajouter une équipe au tournoi"><i class="fa fa-solid fa-plus fa-1x"
                            aria-hidden="true"></i></a>
                @endif
                @if(Gate::allows('isOrg') && $pools->count() > 0)
                        <a href="{{ route('pools.contenders.create', $pools->first()) }}"
                            class="btn btn-main closeButton">Répartition aléatoire</a>
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
                        @if (count($tournament->sport->courts) > 0)
                            @foreach ($tournament->sport->courts as $court)
                                <tr>
                                    <td class="clickable">{{ $court->name }}</td>
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
    <div id="tournament" title="tournament" class="container-fluid">
        <div class="row">
            @foreach ($tournament->getStages() as $key => $stage)
                <div class="col">
                    <x-pool :tournament="$tournament" :stage="$stage" :key="$key" :pool="$pools"></x-pool>
                </div>
            @endforeach
        </div>
    </div>
    
    <script src="{{ asset('js/tournamentView.js') }}"></script>
@stop
