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
        <h1 class="text-center">Tournoi de {{ $tournament->name }} - Phase {{ $pool->stage }} - {{ $pool->poolName }}
        </h1>
        <div class="text-center">
            <h2>Matches et Résultats</h2>
            <h4>État: {{ \App\HelperClasses\PoolHelper::poolState($pool) }}</h4>
            <h4>Date : {{ $tournament->start_date->format('d.m.Y') }}</h4>
            <div class="row justify-content-center">
                <form action="{{ route('games.store') }}" method="post">
                    @csrf
                    <table class="table" id="data_table">
                        <tbody class="text">
                            <!-- Formulaire d'ajout de match si le match est en préparation -->
                            @if ($pool->poolState == 0)
                                <tr>


                                    <input type="hidden" name="date"
                                        value="{{ $tournament->start_date->format('Y-m-d') }}">
                                    <td><input type="time" id="appt" name="start_time"></td>
                                    <td>
                                        <select name="firstContender" id="inputState" class="form-control">
                                            <option selected>Choisir 1ère team </option>
                                            @foreach ($pool->contenders as $contender)
                                                @if ($contender->getName() != null)
                                                    <option value="{{ $contender->id }}">{{ $contender->getName() }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="separator"> - </td>
                                    <td>
                                        <select name="secondContender" id="inputState" class="form-control">
                                            <option selected>Choisir 2ème team</option>
                                            @foreach ($pool->contenders as $contender)
                                                @if ($contender->getName() != null)
                                                    <option value="{{ $contender->id }}">{{ $contender->getName() }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="location" id="inputState" class="form-control">

                                            <option selected>Choisir lieu</option>

                                            @foreach ($courts as $value)
                                                @if ($value->sport_id == $tournament->sport_id)

                                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><button type="submit" class="btn btn-main">Ajouter</button></td>

                                </tr>
                            @endif
                        </tbody>
                    </table>
                </form>
                <form>
                    <table class="table">
                        @foreach ($games as $game)

                            <tbody class="text">
                                <tr data-game="{{ $game->id }}">
                                    <td class="separator sepTime " id="time{{ $game->id }}">
                                        {{ Carbon\Carbon::parse($game->start_time)->format('H:i') }}
                                    </td>
                                    <td>
                                   
                                        <select class="form-control" name="firstContenderEdited[{{ $game->id }}]">
                                            <option selected>Choisir 1ère team </option>
                                            @foreach ($pool->contenders as $contender)
                                                @if ($contender->team->name)
                                                    <option value="{{ $contender->id }}" @if ($contender->team->name == $game->contender1->team->name) selected @endif>
                                                        {{ $contender->team->name}}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="separator"> - </td>

                                    <td>
                                        <select class="form-control" name="secondContenderEdited[{{ $game->id }}]">
                                            <option selected>Choisir 2ère team </option>
                                            @foreach ($pool->contenders as $contender)
                                                @if ($contender->team->name)
                                                    <option value="{{ $contender->id }}" @if ($contender->team->name == $game->contender2->team->name) selected @endif>
                                                        {{ $contender->team->name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                    <td id="courtEdit{{ $game->id }}">

                                        <select name="location" class="form-control"
                                            name="courtEdited[{{ $game->id }}]">



                                            @foreach ($courts as $value)

                                                @if ($value->sport_id == $tournament->sport_id)

                                                    <option value="{{ $value->name }}" @if ($value->name == $game->court->name) selected @endif>{{ $value->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>

                                </tr>
                            <tbody class="text">
                        @endforeach
                    </table>
                </form>
                
                <table class="table">
                    <caption style="caption-side:top; text-align:center">
                        <h2>Liste des participants</h2>
                    </caption>
                    @for ($i = 0; $i < $pool->poolSize; $i++)
                        <tr>
                            <form
                                action="{{ route('pools.contenders.update', [$pool->id, $pool->contenders[$i]->id]) }}"
                                method="POST" enctype="multipart/form-data">
                                <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                                <input type="hidden" name="_method" value="PUT">

                                <td>
                                    <h6 style="color: black">

                                        @if ($pool->contenders[$i]->getName() != null)
                                            {{ $pool->contenders[$i]->getName() }}
                                        @else

                                            <select id="teams" name="team_id" class="form-control">

                                                @foreach ($teamsNotInAPool as $team)
                                                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </h6>
                                </td>
                                <td>

                                    @if ($pool->contenders[$i]->getName() == null)
                                        <button type="submit" class="btn btn-main">Ajouter</button>
                                    @endif
                            </form>
                            @if (isset($pool->id) && isset($pool->contenders[$i]->team_id))

                                <form
                                    action="{{ route('pools.contenders.destroy', [$pool->contenders[$i]->team_id, $pool->id]) }}"
                                    method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger" data-toggle="modal"
                                        data-target="#deleteModal">
                                        <i class="fa fa-trash fa-lg" aria-hidden="true"></i>
                                    </button>
                                </form>
                            @endif
                            </td>

                        </tr>
                    @endfor
                </table>

            </div>
        </div>
    </div>
@stop
