@extends('layout')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <a href="{{ route('tournaments.show', $tournament) }}"><i class="fa fa-4x fa-arrow-circle-left return fa-return growIcon" aria-hidden="true"></i></a>
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
                <h4>Date : {{ $tournament->start_date->format('d.m.Y') }}</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <table class="table" id="data_table">
                    <tbody class="text">
                        @foreach ($games as $game)
                            <!-- teams - no score -->
                            @if (!isset($game->score_contender1) || !isset($game->score_contender2))
                                <td class="separator sepTime ">
                                    {{ Carbon\Carbon::parse($game->start_time)->format('H:i') }}</td>
                                <td class="contender1 ">{{ $game->contender1->team->name }}</td>
                                <td class="separator"> - </td>
                                <td class="contender2">{{ $game->contender2->team->name }}</td>
                                <td class="score2 ">{{ $game->court->name }}</td>
                                @if ($pool->isEditable())
                                    <td class="action"><i class="fa fa-lg fa-clock-o editTime" aria-hidden="true"></i>
                                        <i class="editScore fa fa-trophy fa-lg" aria-hidden="true"></i>
                                    </td>
                                @endif

                            @else
                                <!--teams and score -->
                                <tr style="background-color: #DCDCDC;">
                                    <td class="contender1">{{ $game->contender1->team->name }}</td>
                                    <td class="score1">{{ $game->score_contender1 }}</td>
                                    <td class="separator"> - </td>
                                    <td class="score2">{{ $game->score_contender2 }}</td>
                                    <td class="contender2">{{ $game->contender2->team->name }}</td>
                                </tr>
                                @if ($pool->isEditable())
                                    <td class="action"><i class="fa fa-lg fa-trophy editScore" aria-hidden="true"></i>
                                    </td>
                                @endif
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
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
                        <tr data-id="{{ $rankings[$i]["team_id"] }}" data-rank="{{$i+1}}">
                            <td>{{$i+1}}</td>
                            <td>{{$rankings[$i]["team"]}}</td>
                            <td>{{$rankings[$i]["score"]}}</td>
                            <td>{{$rankings[$i]["W"]}}</td>
                            <td>{{$rankings[$i]["L"]}}</td>
                            <td>{{$rankings[$i]["D"]}}</td>
                            <td>{{$rankings[$i]["+-"]}}</td>
                        </tr>
                    @endfor
                    </tbody>
                </table>
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

@stop
