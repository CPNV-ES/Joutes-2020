@extends('layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <a href="{{ route('tournaments.show', $tournament) }}"><i
                        class="fa fa-4x fa-arrow-circle-left return fa-return growIcon" aria-hidden="true"></i></a>
                <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#updateModal">
                    <i class="fa fa-edit fa-1x" aria-hidden="true"></i>
                </button>
                <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                    <i class="fa fa-trash fa-1x" aria-hidden="true"></i>
                </button>
            </div>

            <div class="col-md-10 text-center">
                <h1 class="text-center">Tournoi de {{ $tournament->name }} - Phase {{ $pool->stage }} -
                    {{ $pool->poolName }}
                </h1>
                <h2>Matches et Résultats</h2>
                <h4>État: {{ \App\Enums\PoolState::poolStateName($pool->poolState) }}</h4>
                @if ($pool->isReady() && $pool->isEditable())
                    <button type="submit" class="btn btn-main" data-toggle="modal" data-target="#stagePoolModal">Passer à
                        l'étape suivante : {{ \App\Enums\PoolState::poolStateName($pool->poolState + 1) }}</button>
                @endif
                <h4>Date : {{ $tournament->start_date->format('d.m.Y') }}</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                @if ($pool->isEditable())
                    <form action="{{ route('games.store') }}" method="post">
                        @csrf
                        <table class="table" id="data_table">
                            <tbody class="text">
                                <tr>
                                    <input type="hidden" name="date"
                                        value="{{ $tournament->start_date->format('Y-m-d') }}">
                                    <td><input type="time" id="appt" name="start_time" required></td>
                                    <td>
                                        <select required name="firstContender" id="inputState" class="form-control">
                                            <option disabled selected value="">Choisir 1ère team </option>
                                            @foreach ($pool->contenders as $contender)
                                                @if ($contender->getName() != null)
                                                    <option value="{{ $contender->id }}">
                                                        {{ $contender->getName() }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="separator"> - </td>
                                    <td>
                                        <select required name="secondContender" id="inputState" class="form-control">
                                            <option disabled selected value="">Choisir 2ème team</option>
                                            @foreach ($pool->contenders as $contender)
                                                @if ($contender->getName() != null)
                                                    <option value="{{ $contender->id }}">
                                                        {{ $contender->getName() }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select required name="location" id="inputState" class="form-control">

                                            <option selected disabled value="">Choisir lieu</option>

                                            @foreach ($courts as $value)
                                                @if ($value->sport_id == $tournament->sport_id)

                                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><button type="submit" class="btn btn-main">Ajouter</button></td>

                                </tr>

                            </tbody>
                        </table>

                    </form>
                @endif
                <form action="{{ route('games.update', 'inprep') }}" method="post">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <table class="table">
                        <tbody class="text">
                            @foreach ($games as $game)

                                <tr id="tr{{ $game->id }}" data-game="{{ $game->id }}">

                                    <input type="hidden" name="game[{{ $game->id }}][game_id]"
                                        value="{{ $game->id }}">
                                    <input type="hidden" id="game{{ $game->id }}isDeleted"
                                        name="game[{{ $game->id }}][isDeleted]" value="0">

                                    @if ($pool->isEditable())
                                        <td><input type="time" id="appt" name="game[{{ $game->id }}][editedTime]"
                                                value="{{ Carbon\Carbon::parse($game->start_time)->format('H:i') }}">
                                        </td>
                                    @else
                                        <td>{{ Carbon\Carbon::parse($game->start_time)->format('H:i') }}</td>
                                    @endif
                                    <td>
                                        @if ($pool->isEditable())
                                            <select id="selectFirstContender{{ $game->id }}" class="form-control"
                                                name="game[{{ $game->id }}][editedContender1]">
                                                <option disabled selected value="">Choisir 1ère team </option>
                                                @foreach ($pool->contenders as $contender)
                                                    @if ($contender->team_id && $game->contender1->team)
                                                        <option value="{{ $contender->id }}" @if ($contender->team->name == $game->contender1->team->name) selected @endif>
                                                            {{ $contender->team->name }}
                                                        </option>
                                                    @elseif($contender->getName())
                                                        <option value="{{ $contender->id }}">
                                                            {{ $contender->getName() }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        @else
                                            @if ($game->contender1->team)
                                                {{ $game->contender1->team->name }}
                                            @else
                                                -VIDE-
                                            @endif
                                        @endif

                                    </td>
                                    <td class="separator"> - </td>

                                    <td>
                                        @if ($pool->isEditable())
                                            <select id="selectSecondContender{{ $game->id }}" class="form-control"
                                                name="game[{{ $game->id }}][editedContender2]">
                                                <option disabled selected value="">Choisir 2ère team </option>
                                                @foreach ($pool->contenders as $contender)
                                                    @if ($contender->team_id && $game->contender2->team)
                                                        <option value="{{ $contender->id }}" @if ($contender->team->name == $game->contender2->team->name) selected @endif>
                                                            {{ $contender->team->name }}
                                                        </option>
                                                    @elseif($contender->getName())
                                                        <option value="{{ $contender->id }}">
                                                            {{ $contender->getName() }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        @else
                                            @if ($game->contender2->team)
                                                {{ $game->contender2->team->name }}
                                            @else
                                                -VIDE-
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        @if ($pool->isEditable())
                                            <select class="form-control" name="game[{{ $game->id }}][editedCourt]">



                                                @foreach ($courts as $value)

                                                    @if ($value->sport_id == $tournament->sport_id)

                                                        <option value="{{ $value->id }}" @if ($value->name == $game->court->name) selected @endif>{{ $value->name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        @else
                                            {{ $game->court->name }}
                                        @endif
                                    </td>
                                    @if ($pool->isEditable())
                                        <td>
                                            <button type="button" class="btn btn-danger"
                                                onclick="del_row({{ $game->id }})">
                                                <i id="trashButton{{ $game->id }}" class="fa fa-trash fa-lg"
                                                    aria-hidden="true"></i>
                                            </button>

                                        </td>
                                    @endif
                                </tr>

                            @endforeach
                        <tbody class="text">
                    </table>
                    @if ($pool->isEditable())
                        <h2><input value="Sauvegarder" type="submit" class="btn btn-main" /></h2>
                    @endif
                </form>

                <table class="table">
                    <caption style="caption-side:top; text-align:center">
                        <h2>Liste des participants</h2>
                    </caption>
                    @for ($i = 0; $i < $pool->poolSize; $i++)
                        <tr>
                            <form action="{{ route('pools.contenders.update', [$pool->id, $pool->contenders[$i]->id]) }}"
                                method="POST" enctype="multipart/form-data">
                                <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                                <input type="hidden" name="_method" value="PUT">

                                <td>
                                    <h6 style="color: black">

                                        @if ($pool->contenders[$i]->getName() != null)
                                            {{ $pool->contenders[$i]->getName() }}
                                        @elseif ($pool->isEditable())

                                            <select id="teams" name="team_id" class="form-control">

                                                @foreach ($teamsNotInAPool as $team)
                                                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            -VIDE-
                                        @endif
                                    </h6>
                                </td>


                                @if ($pool->contenders[$i]->getName() == null && $pool->isEditable())
                                    <td>
                                        <button type="submit" class="btn btn-main">Ajouter</button>
                                    </td>
                                @endif
                            </form>

                            @if ($pool->isEditable())
                                @if (isset($pool->id) && isset($pool->contenders[$i]->team_id))
                                    <td>
                                        <form
                                            action="{{ route('pools.contenders.destroy', [$pool->contenders[$i]->team_id, $pool->id]) }}"
                                            method="POST">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-trash fa-lg" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    </td>
                                @endif
                            @endif


                        </tr>
                    @endfor
                </table>

            </div>
        </div>
    </div>

    <!-- Modal Deletion -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <i class="fas fa-times-circle fa-4x" style="color: red;"></i>
                    <h5 class="modal-title pl-3 pt-3" id="deleteModalLabel">Souhaitez-vous vraiment le supprimer ?
                    </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <form action="{{ route('tournaments.pools.destroy', [$tournament, $pool]) }}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Update -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <i class="fas fa-times-circle fa-4x" style="color: red;"></i>
                    <h5 class="modal-title pl-3 pt-3" id="updateModalLabel">Modifier le nom</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-footer">
                    <form action="{{ route('tournaments.pools.update', [$tournament, $pool]) }}" method="POST">
                        @csrf
                        <input type="text" name="poolName">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <input type="hidden" name="_method" value="PATCH">
                        <button type="submit" class="btn btn-success">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal StagePool -->
    <div class="modal fade" id="stagePoolModal" tabindex="-1" role="dialog" aria-labelledby="stagePoolModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <i class="fas fa-times-circle fa-4x" style="color: red;"></i>
                    <h5 class="modal-title pl-3 pt-3" id="stagePoolModalLabel">Êtes-vous sûr de vouloir faire ça?
                    </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-footer">
                    <form action="{{ route('tournaments.pools.update', [$tournament, $pool]) }}" method="POST">
                        @csrf
                        <input hidden type="number" value="1" name="poolState">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <input type="hidden" name="_method" value="PATCH">
                        <button type="submit" name="changeStatePool" class="btn btn-success">Ok !</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/poolShow.js') }}"></script>
@stop
