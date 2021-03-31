@extends('layout')

@section('content')

    
    <div class="container">
        <h1 class="text-center">Tournoi de {{$tournament->name}} - Phase {{$pool->stage}} - {{$pool->poolName}}</h1>
        <div class="text-center">
            <h2>Matches et Résultats</h2>
            <h4>État: {{\App\HelperClasses\PoolHelper::poolState($pool)}}</h4>
            
            <!-- Si pool n'est plus en préparation -->
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
            <!-- -------------------------------- -->
            <h4>Date : {{$tournament->start_date->format('d.m.Y')}}</h4>
            <div class="row justify-content-center">
                <table class="table" id="data_table">
                    <tbody class="text">
                    <!-- Formulaire d'ajout de match si le match est en préparation -->
                    @if ($pool->poolState == 0)
                    <tr>
                    <form action="{{ route('games.store')}}" method="post">
                        @csrf
                        <input type="hidden" name="date" value="{{$tournament->start_date->format('Y-m-d')}}">
                        <td><input type="time" id="appt" name="start_time"></td>
                        <td>
                            <select name="firstContender" id="inputState" class="form-control">
                                <option selected>Choisir 1ère team </option>
                                    @foreach($pool->contenders as $contender)
                                        @if($contender->getName()!=null)
                                            <option value="{{$contender->id}}">{{ $contender->getName() }}</option>
                                        @endif
                                    @endforeach
                            </select>
                        </td>
                        <td class="separator"> - </td>
                        <td>
                            <select name="secondContender" id="inputState" class="form-control">
                                <option selected>Choisir 2ème team</option>
                                @foreach($pool->contenders as $contender)
                                    @if($contender->getName()!=null)
                                    <option value="{{$contender->id}}">{{ $contender->getName() }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select name="location" id="inputState" class="form-control">
                            
                                <option selected>Choisir lieu</option>
                                
                                @foreach($courts as $value)
                                    @if($value->sport_id == $tournament->sport_id)

                                    <option value="{{$value->id}}">{{ $value->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </td>
                        <td><button type="submit" class="btn btn-main">Ajouter</button></td>
                    </form>
                    </tr>
                    @endif

                    @if(count($games) > 0)
                    
                        @foreach ($games as $game)
                        <form action="{{ route('games.update', $game->id) }}" method="POST">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                        <input type="hidden" name="_method" value="PUT">
                            <tr data-game="{{$game->id}}">
                                
                                <!-- No teams - no score -->
                                @if (empty($game->contender1->team) || empty($game->contender2->team))
                                <td class="separator sepTime " id="time{{ $game->id }}">{{Carbon\Carbon::parse($game->start_time)->format('H:i')}}</td>
                                    @if ((empty($game->contender1->team))&&(isset($game->contender1->fromPool->poolName)))
                                        <td class="contender1">{{ $game->contender1->rank_in_pool . ($game->contender1->rank_in_pool == 1 ? "er " : 'ème ') . "de " . $game->contender1->fromPool->poolName }}</td>
                                    @elseif($game->contender1->getName()!=null)
                                        <td class="contender1" id="contender1_row{{ $game->id }}">{{ $game->contender1->team->name }}</td>
                                    @else
                                        <td id="contender1_row{{ $game->id }}">! VIDE !</td>
                                    @endif
                                    <td style="display:none" id="firstContenderEdit{{ $game->id }}"><select name="firstContenderEdited" class="form-control">
                                        <option selected>Choisir 1ère team </option>
                                            @foreach($pool->contenders as $contender)
                                                @if($contender->getName()!=null)
                                                    <option value="{{$contender->id}}">{{ $contender->getName() }}</option>
                                                @endif
                                            @endforeach
                                    </select></td>
                                    <td class="separator"> - </td>
                                    <td style="display:none" id="secondContenderEdit{{ $game->id }}">
                                    <select class="form-control" name="secondContenderEdited">
                                        <option selected>Choisir 1ère team </option>
                                            @foreach($pool->contenders as $contender)
                                                @if($contender->getName()!=null)
                                                    <option value="{{$contender->id}}">{{ $contender->getName() }}</option>
                                                @endif
                                            @endforeach
                                    </select></td>
                                    @if ((empty($game->contender2->team))&&(isset($game->contender2->fromPool->poolName)))
                                        <td class="contender2">{{ $game->contender2->rank_in_pool . ($game->contender2->rank_in_pool == 1 ? "er " : 'ème ') . "de " . $game->contender2->fromPool->poolName }}</td>
                                    @elseif(isset($game->contender2->team->name))
                                        <td class="contender2" id="contender2_row{{ $game->id }}">{{ $game->contender2->team->name }}</td>
                                    @else
                                        <td id="contender2_row{{ $game->id }}">! VIDE !</td>
                                    @endif
                                    <td class="score2" id="court{{ $game->id }}">{{ $game->court->name }}</td>
                                    <td id="courtEdit{{ $game->id }}" style="display:none">
                                        <select name="location"  class="form-control" name="courtEdited">
                                        
                                            <option selected>Choisir lieu</option>
                                            
                                            @foreach($courts as $value)
                                                @if($value->sport_id == $tournament->sport_id)

                                                <option value="{{$value->id}}">{{ $value->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>

                                    <td id="edit_button{{$game->id}}"><button type="button" class="btn btn-success edit_button" id="edit_button{{$game->id}}" onclick="edit_row('{{ $game->id }}')">
                                            <i class="fa fa-edit fa-1x" aria-hidden="true"></i>
                                        </button>
                                    </td>
                                    <td id="save_button{{ $game->id }}" style="display:none">
                                            <button type="submit" class="btn">
                                            <i class="fas fa-save"></i>
                                            </button>
                                        </td>
                                    
                                @else
                                     <!-- teams - no score -->
                                    @if(!isset($game->score_contender1) || !isset($game->score_contender2))
                                        <td class="separator sepTime " id="time{{ $game->id }}">{{Carbon\Carbon::parse($game->start_time)->format('H:i')}}</td>
                                        @if($game->contender1->getName() != null)
                                        <td class="contender1 " id="contender1_row{{ $game->id }}">{{$game->contender1->team->name}}</td>
                                        @endif
                                        <td  style="display:none" id="firstContenderEdit{{ $game->id }}">
                                            <select class="form-control" name="firstContenderEdited">
                                                <option selected>Choisir 1ère team </option>
                                                    @foreach($pool->contenders as $contender)
                                                        @if($contender->getName()!=null)
                                                            <option value="{{$contender->id}}">{{ $contender->getName() }}</option>
                                                        @endif
                                                    @endforeach
                                            </select>
                                        </td>
                                        <td class="separator"> - </td>
                                        <td style="display:none" id="secondContenderEdit{{ $game->id }}">
                                            <select class="form-control" name="secondContenderEdited">
                                                <option selected>Choisir 1ère team </option>
                                                    @foreach($pool->contenders as $contender)
                                                        @if($contender->getName()!=null)
                                                            <option value="{{$contender->id}}">{{ $contender->getName() }}</option>
                                                        @endif
                                                    @endforeach
                                            </select>
                                        </td>
                                        @if($game->contender2->getName()!= null)
                                        <td class="contender2" id="contender2_row{{ $game->id }}">{{$game->contender2->team->name}}</td>
                                        @endif
                                        <td class="score2 " id="court{{ $game->id }}">{{ $game->court->name }}</td>
                                        <td id="courtEdit{{$game->id }}" style="display:none">
                                            <select name="location"  class="form-control" name="courtEdited">
                                        
                                            <option selected>Choisir lieu</option>
                                                
                                                @foreach($courts as $value)
                                                    @if($value->sport_id == $tournament->sport_id)

                                                    <option value="{{$value->id}}">{{ $value->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </td>
                                        @if($pool->isEditable())
                                            <td class="action"><i class="fa fa-lg fa-clock-o editTime" aria-hidden="true"></i> <i class="editScore fa fa-trophy fa-lg" aria-hidden="true"></i></td>
                                        @endif
                                        <td id="edit_button{{$game->id}}"><button type="button" class="btn btn-success edit_button" id="edit_button{{$game->id}}" onclick="edit_row('{{ $game->id }}')">
                                            <i class="fa fa-edit fa-1x" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                        <td id="save_button{{ $game->id }}" style="display:none">
                                            <button type="submit" class="btn">
                                            <i class="fas fa-save"></i>
                                            </button>
                                        </td>
                                        
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
                            </form>
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
                        <form action="{{ route('pools.contenders.update', [$pool->id , $pool->contenders[$i]->id]) }}" method="POST" enctype="multipart/form-data">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                        <input type="hidden" name="_method" value="PUT">
                        
                        <td>
                            <h6 style="color: black">
                               
                                @if($pool->contenders[$i]->getName()!=null)
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
                        
                        @if($pool->contenders[$i]->getName()==null)
                        <button type="submit" class="btn btn-main">Ajouter</button>
                        @endif
                        </form>
                        @if(isset($pool->id) && isset($pool->contenders[$i]->team_id))
                        
                            <form action="{{ route('pools.contenders.destroy', [$pool->contenders[$i]->team_id, $pool->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                                    <i class="fa fa-trash fa-lg" aria-hidden="true"></i>
                                </button>
                            </form>
                        @endif
                        </td>
                        
                    </tr>
                @endfor
                </table>
           
            @endif
            
        </div>
    </div>
    <script src="{{ asset('js/poolShow.js') }}"></script>
@stop


