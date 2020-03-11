@extends('layout')

@section('content')

    <div class="container">
        <h1 class="text-center">Tournoi de {{$tournament->name}} - Phase {{$pool->stage}} - {{$pool->poolName}}</h1>
        <div class="text-center">
            <h2>Matchs et Résultats</h2>
            <h4>Date : {{$tournament->start_date->format('d.m.Y')}}</h4>
            <div class="row justify-content-center">
                <table class="table">
                    <tbody class="text">
                    @if(count($games) > 0)
                        @foreach ($games as $game)
                            <tr data-game="{{$game->id}}">
                                <!-- No teams - no score -->
                                @if (empty($game->contender1->team) || empty($game->contender2->team))

                                    @if (empty($game->contender1->team))
                                        <td class="contender1">{{ $game->contender1->rank_in_pool . ($game->contender1->rank_in_pool == 1 ? "er " : 'ème ') . "de " . $game->contender1->fromPool->poolName }}</td>
                                    @else
                                        <td class="contender1">{{ $game->contender1->team->name }}</td>
                                    @endif
                                    <td class="separator sepTime">{{Carbon\Carbon::parse($game->start_time)->format('H:i')}}</td>
                                    <td class="score2">{{ $game->court->name }}</td>

                                    @if (empty($game->contender2->team))
                                        <td class="contender2">{{ $game->contender2->rank_in_pool . ($game->contender2->rank_in_pool == 1 ? "er " : 'ème ') . "de " . $game->contender2->fromPool->poolName }}</td>
                                    @else
                                        <td class="contender2">{{ $game->contender2->team->name }}</td>
                                    @endif

                                    @if($pool->isEditable())
                                        <td class="action"><i class="fa fa-lg fa-clock-o editTime" aria-hidden="true"></i></td>
                                    @endif
                                @else

                                     <!-- teams - no score -->
                                    @if(!isset($game->score_contender1) || !isset($game->score_contender2))
                                        <td class="separator sepTime ">{{Carbon\Carbon::parse($game->start_time)->format('H:i')}}</td>
                                        <td class="contender1 ">{{$game->contender1->team->name}}</td>
                                        <td class="separator"> - </td>
                                        <td class="contender2">{{$game->contender2->team->name}}</td>
                                        <td class="score2 ">{{ $game->court->name }}</td>
                                        @if($pool->isEditable())
                                            <td class="action"><i class="fa fa-lg fa-clock-o editTime" aria-hidden="true"></i> <i class="editScore fa fa-trophy fa-lg" aria-hidden="true"></i></td>
                                        @endif
                                    @else
                                        <!--teams and score -->
                                        <td class="contender1">{{$game->contender1->team->name}}</td>
                                        <td class="score1">{{$game->score_contender1}}</td>
                                        <td class="separator"> - </td>
                                        <td class="score2">{{$game->score_contender2}}</td>
                                        <td class="contender2">{{$game->contender2->team->name}}</td>
                                        @if($pool->isEditable())
                                            <td class="action"><i class="fa fa-lg fa-trophy editScore" aria-hidden="true"></i></td>
                                        @endif
                                    @endif
                                @endif
                            </tr>
                        @endforeach
                    @else

                        Aucun match pour l'instant ...

                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="text-center">
            <h2>Classement actuel</h2>
            @if(sizeof($pool->rankings()) > 0)
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

                    @for ($i = 0; $i < sizeof($pool->rankings()); $i++)
                        <tr data-id="{{ $pool->rankings()[$i]["team_id"] }}" data-rank="{{$i+1}}">
                            <td>{{$i+1}}</td>
                            <td>{{$pool->rankings()[$i]["team"]}}</td>
                            <td>{{$pool->rankings()[$i]["score"]}}</td>
                            <td>{{$pool->rankings()[$i]["W"]}}</td>
                            <td>{{$pool->rankings()[$i]["L"]}}</td>
                            <td>{{$pool->rankings()[$i]["D"]}}</td>
                            <td>{{$pool->rankings()[$i]["+-"]}}</td>
                        </tr>
                    @endfor
                </tbody>
            </table>
            @else
                Indisponible
            @endif
        </div>
    </div>
@stop
