@extends('layout')

@section('content')

    <div class="container">
        <h1>Tournoi de {{$tournament->name}} - Phase {{$pool->stage}} - {{$pool->poolName}}</h1>
        <div class="text-center">
            <h2>Matchs et Résultats</h2>
            <h4>Date : {{$tournament->start_date->format('d.m.Y')}}</h4>
            <div class="row justify-content-center">
                <table class="table">
                    <tbody class="text">
                        <tr>
                            <div class="col-2 text-left">badboys</div>
                            <div class="col-1 text-right">6</div>
                            <div class="col-1">-</div>
                            <div class="col-1 text-left">10</div>
                            <div class="col-2 text-right">SuperNanas</div>
                        </tr>
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
