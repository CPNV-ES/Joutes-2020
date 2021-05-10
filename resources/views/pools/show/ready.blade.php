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
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>



            </div>
            <h2>Liste des participants</h2>

            @foreach ($contenders as $contender)

                <h6 style="color: black" value="{{ $contender[' pool_from_id'] }}">
                    {{ $contender->rank_in_pool . ($contender->rank_in_pool == 1 ? 'er ' : 'ème ') . 'de ' . $contender->fromPool->poolName }}
                </h6>

            @endforeach

        </div>
    </div>
@stop
