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
                    {{ $pool->poolName }}</h1>

                <h2>Matches et Résultats</h2>
                <h4>État: {{ \App\Enums\PoolState::poolStateName($pool->poolState) }}</h4>
                @if ($pool->isEditable() && Helper::eventStateName($pool->tournament->event->eventState) == 'En cours')
                    <button type="submit" class="btn btn-main" data-toggle="modal" data-target="#stagePoolModal">Passer à l'étape suivante : {{ \App\Enums\PoolState::poolStateName($pool->poolState + 1) }}</button>
                @else
                    <h5>En attente de l'activation de l'évènement</h5>
                @endif
                <h4>Date : {{ $tournament->start_date->format('d.m.Y') }}</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                @if (count($games) > 0)
                    <form action="{{ route('games.update', 'inprogress') }}" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <table class="table" id="data_table">
                            <tbody class="text">
                                @foreach ($games as $game)
                                    <input type="hidden" name="game[{{ $game->id }}][game_id]"
                                        value="{{ $game->id }}">
                                    <!-- teams - no score -->
                                    @if (!isset($game->score_contender1) && !isset($game->score_contender2))
                                        <tr>
                                            <td class="separator sepTime ">
                                            @if ($pool->isEditable())
                                                <td><input type="time" name="game[{{ $game->id }}][editedTime]"
                                                           value="{{ Carbon\Carbon::parse($game->start_time)->format('H:i') }}">
                                                </td>
                                            @else
                                                <td>{{ Carbon\Carbon::parse($game->start_time)->format('H:i') }}</td>
                                            @endif
                                            <td class="contender1 ">
                                                @if (empty($game->contender1->team))
                                                    {{ $game->contender1->rank_in_pool . ($game->contender1->rank_in_pool == 1 ? 'er ' : 'ème ') . 'de ' . $game->contender1->fromPool->poolName }}
                                                @else
                                                    {{ $game->contender1->team->name }}
                                                @endif
                                            </td>
                                            <td><input type="number" name="game[{{ $game->id }}][scorecontender1]"
                                                    class="form-control" min="0" max="100" @if (!$pool->isEditable()) disabled @endif /></td>
                                            <td class="separator"> - </td>
                                            <td><input type="number" name="game[{{ $game->id }}][scorecontender2]"
                                                    class="form-control" min="0" max="100" @if (!$pool->isEditable()) disabled @endif /></td>
                                            <td class="contender2">
                                                @if (empty($game->contender2->team))
                                                    {{ $game->contender2->rank_in_pool . ($game->contender2->rank_in_pool == 1 ? 'er ' : 'ème ') . 'de ' . $game->contender2->fromPool->poolName }}
                                                @else
                                                    {{ $game->contender2->team->name }}
                                                @endif
                                            </td>
                                        </tr>
                                    @else
                                        <!--teams and score -->
                                        <tr style="background-color: #DCDCDC;">
                                            <td class="separator sepTime ">
                                                {{ Carbon\Carbon::parse($game->start_time)->format('H:i') }}</td>
                                            <td class="contender1 ">
                                                @if (empty($game->contender1->team))
                                                    {{ $game->contender1->rank_in_pool . ($game->contender1->rank_in_pool == 1 ? 'er ' : 'ème ') . 'de ' . $game->contender1->fromPool->poolName }}
                                                @else
                                                    {{ $game->contender1->team->name }}
                                                @endif
                                            </td>

                                            <td><input type="number" name="game[{{ $game->id }}][scorecontender1]"
                                                    class="form-control" min="0" max="100"
                                                    value="{{ $game->score_contender1 }}" @if (!$pool->isEditable()) disabled @endif /></td>
                                            <td class="separator"> - </td>
                                            <td><input type="number" name="game[{{ $game->id }}][scorecontender2]"
                                                    class="form-control" min="0" max="100"
                                                    value="{{ $game->score_contender2 }}" @if (!$pool->isEditable()) disabled @endif /></td>

                                            <td class="contender2">
                                                @if (empty($game->contender2->team))
                                                    {{ $game->contender2->rank_in_pool . ($game->contender2->rank_in_pool == 1 ? 'er ' : 'ème ') . 'de ' . $game->contender2->fromPool->poolName }}
                                                @else
                                                    {{ $game->contender2->team->name }}
                                                @endif
                                            </td>
                                        </tr>

                                    @endif

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if ($pool->isEditable())
                            <h2><input value="Sauvegarder" type="submit" class="btn btn-main" /></h2>
                        @endif
                    </form>
            </div>
            @endif

            @if ($pool->poolState >= \App\Enums\PoolState::Inprog)
                <h2>Classement actuel</h2>
                <table class="table">
                    <thead class="black white-text">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Équipes</th>
                            <th scope="col">Pts</th>
                            <th scope="col">G</th>
                            <th scope="col">P</th>
                            <th scope="col">N</th>
                            <th scope="col">+/-</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < sizeof($rankings); $i++)
                            <tr data-id="{{ $rankings[$i]['team_id'] }}" data-rank="{{ $i + 1 }}">
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $rankings[$i]['team'] }}</td>
                                <td>{{ $rankings[$i]['score'] }}</td>
                                <td>{{ $rankings[$i]['W'] }}</td>
                                <td>{{ $rankings[$i]['L'] }}</td>
                                <td>{{ $rankings[$i]['D'] }}</td>
                                <td>{{ $rankings[$i]['+-'] }}</td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            @endif

        </div>
    </div>
    <!-- Modal Deletion -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <i class="fas fa-times-circle fa-4x" style="color: red;"></i>
                    <h5 class="modal-title pl-3 pt-3" id="deleteModalLabel">Souhaitez-vous vraiment le supprimer ?</h5>

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
                    <h5 class="modal-title pl-3 pt-3" id="stagePoolModalLabel">Êtes-vous sûr de vouloir faire ça?</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-footer">
                    <form action="{{ route('tournaments.pools.update', [$tournament, $pool]) }}" method="POST">
                        @csrf
                        <input hidden type="number" value="3" name="poolState">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <input type="hidden" name="_method" value="PATCH">
                        <button type="submit" name="changeStatePool" class="btn btn-success">Ok !</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @section('customScript')
        <script>
            $("input:regex(name, game\\[\\d*\\]\\[editedTime\\])").each((index, element)=>{
                let items = $("input:regex(name, game\\[\\d*\\]\\[editedTime\\])")
                $(element).change((event) => {
                    for (let itemIndex = index + 1; itemIndex < items.length; itemIndex++){
                        items[itemIndex].value = Time($(element).val()).addMinutes((itemIndex - index) * 10).toString();
                    }
                })
            })
        </script>
    @stop
@stop
