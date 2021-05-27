@extends('layout')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-3">
                <a href="{{ route('tournaments.show', $tournament) }}"><i class="fa fa-4x fa-arrow-circle-left return fa-return growIcon" aria-hidden="true"></i></a>
                <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#updateModal">
                    <i class="fa fa-edit fa-2x" aria-hidden="true"></i>
                </button>
                <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                    <i class="fa fa-trash fa-2x" aria-hidden="true"></i>
                </button>
            </div>

        <div class="text-center">
            <h1 class="text-center">Tournoi de {{ $tournament->name }} - Phase {{ $pool->stage }} -
                {{ $pool->poolName }}</h1>

            <h2>Matches et Résultats</h2>
            <h4>État: {{ \App\Enums\PoolState::poolStateName($pool->poolState) }}</h4>
            @if($pool->isEditable() && \App\Enums\EventState::eventStateName($pool->tournament->event->eventState) == "En cours")
                <button type="submit" class="btn btn-main" data-toggle="modal" data-target="#stagePoolModal">Passer à l'étape suivante</button>
            @else
                <h5>En attente de l'activation de l'évènement</h5>
            @endif
            <h4>Date : {{ $tournament->start_date->format('d.m.Y') }}</h4>

            <div class="row justify-content-center">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <table class="table" id="data_table">
                    <tbody class="text">
                        @foreach ($games as $game)
                            <tr>
                                @if (empty($game->contender1->team) || empty($game->contender2->team))
                                    <td class="separator sepTime " id="time{{ $game->id }}">
                                        {{ Carbon\Carbon::parse($game->start_time)->format('H:i') }}</td>
                                    <td class="contender1">
                                        {{ $game->contender1->rank_in_pool . ($game->contender1->rank_in_pool == 1 ? 'er ' : 'ème ') . 'de ' . $game->contender1->fromPool->poolName }}
                                    </td>
                                    <td class="separator"> - </td>

                                    <td class="contender2">
                                        {{ $game->contender2->rank_in_pool . ($game->contender2->rank_in_pool == 1 ? 'er ' : 'ème ') . 'de ' . $game->contender2->fromPool->poolName }}
                                    </td>
                                    <td class="score2" id="court{{ $game->id }}">{{ $game->court->name }}
                                    </td>
                                @else
                                    <td class="separator sepTime " id="time{{ $game->id }}">
                                        {{ Carbon\Carbon::parse($game->start_time)->format('H:i') }}</td>
                                    <td class="contender1">{{ $game->contender1->team->name }}</td>
                                    <td class="separator"> - </td>

                                    <td class="contender2">{{ $game->contender2->team->name }}</td>
                                    <td class="score2" id="court{{ $game->id }}">{{ $game->court->name }}
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>



            </div>

            @if(\App\Contender::isAllEmpty($contenders))
                <h2>Liste des participants</h2>
                <table class="table">
                    @foreach($contenders as $contender)
                        <tr><td>
                        @if ($contender->getName() != null)
                            {{ $contender->getName() }}
                        @endif
                        <td></tr>
                    @endforeach
                </table>
            @else
                <h2>Liste des participants</h2>
                @foreach($contenders as $contender)
                    <h6 style="color: black" value="{{$contender[' pool_from_id']}}">{{$contender->rank_in_pool .($contender->rank_in_pool == 1 ? "er " : 'ème ') . "de "  . $contender->fromPool->poolName}}</h6>
                @endforeach
            @endif

        </div>
    </div>
    <!-- Modal Deletion -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
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
                    <form action="{{ route('tournaments.pools.update',[$tournament, $pool]) }}" method="POST">
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
    <div class="modal fade" id="stagePoolModal" tabindex="-1" role="dialog" aria-labelledby="stagePoolModalLabel" aria-hidden="true">
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
                    <form action="{{ route('tournaments.pools.update',[$tournament, $pool]) }}" method="POST">
                        @csrf
                        <input hidden type="number" value="2" name="poolState">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <input type="hidden" name="_method" value="PATCH">
                        <button type="submit" name="changeStatePool" class="btn btn-success">Ok !</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
