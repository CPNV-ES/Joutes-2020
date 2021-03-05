@extends('layout')

@section('content')

    <?php 
        $mainArray = array ();
        foreach ($pool->teams as $team){
            array_push($mainArray,[$team->id,$team->name]);
        }
                        
    ?>
    <div class="container">
        <h1 class="text-center">Tournoi de {{$tournament->name}} - Phase {{$pool->stage}} - {{$pool->poolName}}</h1>
        <div class="text-center">
            <h2>Matches et Résultats</h2>
            <h4>État: {{\App\HelperClasses\PoolHelper::poolState($pool)}}</h4>
            @if ($pool->stage > 1 && count($pool->contenders) < $pool->poolSize)
            <h2>Définition des équipes</h2>
            <table>
                <tr>
                    <th>Issu de la poule</th>
                    <th>Classé</th>
                </tr>
                <tr>
                    <form action="{{ route('pools.contenders.store', $pool->id) }}" method="post">
                        @csrf
                        <td>
                            <select name="pool_from_id" id="pool_from_id">
                                @foreach ($poolsInPreviousStage as $poolInPreviousStage)
                                <option value="{{ $poolInPreviousStage->id }}">{{ $poolInPreviousStage->poolName }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="number" name="rank_in_pool" id="rank_in_pool" min="1">

                        </td>
                        <td>
                            <button type="submit" class="btn btn-main">+</button>
                        </td>
                    </form>
                </tr>
            </table>
            @endif
            <h4>Date : {{$tournament->start_date->format('d.m.Y')}}</h4>
            <div class="row justify-content-center">
                <table class="table">
                    <tbody class="text">
                    @if(count($games) > 0)
                        @foreach ($games as $game)
                            <tr data-game="{{$game->id}}">
                                <!-- No teams - no score -->
                                @if (empty($game->contender1->team) || empty($game->contender2->team))

                                    @if ((empty($game->contender1->team))&&(isset($game->contender1->fromPool->poolName)))
                                        <td class="contender1">{{ $game->contender1->rank_in_pool . ($game->contender1->rank_in_pool == 1 ? "er " : 'ème ') . "de " . $game->contender1->fromPool->poolName }}</td>
                                    @elseif(isset($game->contender1->team->name))
                                        <td class="contender1">{{ $game->contender1->team->name }}</td>
                                    @else
                                    <td>
                                    <select id="inputState" class="form-control">
                                        <option selected>Choisir team</option>
                                        @foreach($mainArray as $value)
                                            <option>{{ $value[1] }}</option>
                                        @endforeach
                                    </select>
                                    </td>
                                    @endif
                                    <td class="separator sepTime">{{Carbon\Carbon::parse($game->start_time)->format('H:i')}}</td>
                                    <td class="score2">{{ $game->court->name }}</td>

                                    @if ((empty($game->contender2->team))&&(isset($game->contender2->fromPool->poolName)))
                                        <td class="contender2">{{ $game->contender2->rank_in_pool . ($game->contender2->rank_in_pool == 1 ? "er " : 'ème ') . "de " . $game->contender2->fromPool->poolName }}</td>
                                    @elseif(isset($game->contender2->team->name))
                                        <td class="contender2">{{ $game->contender2->team->name }}</td>

                                    @else
                                    <td>
                                    <select id="inputState" class="form-control">
                                        <option selected>Choisir team</option>
                                        @foreach($mainArray as $value)
                                            <option>{{ $value[1] }}</option>
                                        @endforeach
                                    </select>
                                    </td>
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
                                        <tr style="background-color: #DCDCDC;">
                                            <td class="contender1">{{$game->contender1->team->name}}</td>
                                            <td class="score1">{{$game->score_contender1}}</td>
                                            <td class="separator"> - </td>
                                            <td class="score2">{{$game->score_contender2}}</td>
                                            <td class="contender2">{{$game->contender2->team->name}}</td>
                                        </tr>
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
            @if($pool->poolState >= 2)
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
            @elseif(\App\Contender::isAllEmpty($contenders))
                <h2>Liste des participants</h2>
                <table class="table">

                
                   
                    
               
                @for($i = 0;$i < $pool->poolSize; $i++ )
                    <tr>
                        <td>
                            <h6 style="color: black">
                                @if(isset($mainArray[$i][1]))
                                    {{ $mainArray[$i][1] }}
                                @else
                                    !Vide!
                                @endif
                            </h6>
                            </td>
                        <td>
                        <td>
                        @if((isset($pool->id)) && (isset($mainArray[$i][0])))
                            <form action="{{ route('pools.contenders.destroy', [$mainArray[$i][0], $pool->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                                    <i class="fa fa-trash fa-lg" aria-hidden="true"></i>
                                </button>
                            </form>
                        @endif
                        </td>
                        </td>
                    </tr>
                @endfor
                </table>
            @else
                <h2>Liste des participants</h2>
                @foreach($contenders as $contender)
                    <h6 style="color: black" value="{{$contender[' pool_from_id']}}">{{$contender->rank_in_pool .($contender->rank_in_pool == 1 ? "er " : 'ème ') . "de "  . $contender->fromPool->poolName}}</h6>
                @endforeach
            @endif
            @if($pool->stage == 1 && count($teamsNotInAPool) > 0)
            <form action="{{ route('pools.contenders.store', $pool->id) }}" method="post">
                @csrf
                <table class="table">
                    
                    <tr>
                        <td>
                            <select id="teams" name="team_id" class="form-control">
                                @foreach ($teamsNotInAPool as $team)
                                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                                @endforeach
                            </select>
                            </td>
                            <td>
                            <button type="submit" class="btn btn-main">Ajouter</button>
                    </td>
                    </tr>
                </table>
                
            </form>
            @endif
        </div>
    </div>
@stop
