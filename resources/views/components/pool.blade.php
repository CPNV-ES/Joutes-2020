@if($key === 0)
    <h3> stage {{ $stage }}</h3>
        @foreach ($tournament->getPoolsOfStage($tournament->id, $stage) as $pool)
        <div class="row">
            <div title="poule {{ $stage }}" class="col">{{ $pool->name }}
                <table id="" class="tableTeamList table table-bordered ">
                    <thead class="{{\App\Enums\PoolState::poolStateClassColor($pool->poolState)}}">
                    <tr>
                        <th title="Teams In" class="teamlist">
                            <a href="{{ route('tournaments.pools.show', [$tournament->id, $pool]) }}"> {{ $pool->poolName }} </a>
                            <br><a
                                class="poolHeader"> {{ \App\Enums\PoolState::poolStateName($pool->poolState) }}</a>
                            @php
                                $countPlayed = 0;
                                $countPlanned = 0;
                            @endphp
                            @foreach($pool->games as $keyGame =>  $game)
                                @if ($keyGame === 0)
                                    <br><a class="poolHeader">commence
                                        à {{ Carbon\Carbon::parse($game->start_time)->format('H:i') }}</a>
                                @endif
                                @if($game->score_contender1 !== null && $game->score_contender2 !== null)
                                    @php
                                        $countPlayed++;
                                    @endphp
                                @else
                                    @php
                                        $countPlanned++;
                                    @endphp
                                @endif
                            @endforeach

                            @if( $pool->poolState == 2)
                                <br><a class="poolHeader">jouée : {{ $countPlayed }}</a>
                                <br><a class="poolHeader"> plannifiée : {{ $countPlanned }}</a>
                            @endif
                        </th>
                        <th title="Teams Out" class="teamlist">Classement</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <td>
                            @php
                                $allGamePlayed = false;
                            @endphp
                            @foreach($pool->games as $game)
                                @if($game->score_contender1 === null && $game->score_contender2 === null)
                                    @php
                                        $allGamePlayed = false;
                                    @endphp
                                @else
                                    @if($pool->poolState == 2)
                                        @php
                                            $allGamePlayed = true;
                                        @endphp
                                    @endif
                                @endif
                            @endforeach
                            <table title="Teams In" class="table table-bordered teamlist tableStyle">
                                @foreach ($pool->contenders->sortBy('rank_in_pool') as $contender)
                                    <tr>
                                        <td title="Team" id="{{ $pool->id.'-'.$contender->id }}">
                                            <form
                                                action="{{ route('pools.contenders.update', [$pool, $contender]) }}"
                                                method="post">

                                                @csrf
                                                @method('put')
                                                <select onchange="this.form.submit()" name="team_id">
                                                    <option selected="true" disabled="disabled"> ----
                                                    </option>
                                                    @if ($contender->team_id === null)
                                                        @foreach ($tournament->getTeamsNotInAPool() as $team)

                                                            <option
                                                                value="{{ $team->id }}">{{ $team->name  }}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach ($tournament->getTeamForPool(\App\Helpers\ContenderHelper::contenderDisplayName($contender)) as $team)
                                                            <option
                                                                value="{{ $team->id}}" {{$team->name == \App\Helpers\ContenderHelper::contenderDisplayName($contender)?'selected':''}}>{{ $team->name  }}</option>
                                                        @endforeach
                                                    @endif


                                                </select>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach

                            </table>

                        </td>

                        <td>
                            <table title="Teams Out" class="table table-bordered teamlist tableStyle">
                                @for ($i = 1; $i <= $pool->poolSize; $i++)
                                    <tr>
                                        <td title="Team" class="team"
                                            id="{{ $pool->id.'-'.$i }}">{{ $i }}</td>
                                    </tr>
                                @endfor
                            </table>

                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="btn-toolbar">
            @if (Gate::allows('isOrg') && $pool->areAllGamesPlayed())
                <div class="col">
                    <a href="{{ route('tournaments.pools.close', $pool) }}" class="btn btn-main closeButton">
                        Terminer la pool
                    </a>
                </div>
                @endif
            @if ($pool->allowMatchesGeneration())
                <div class="col">
                    <form name="generate-matches" method="post" action="{{ route('pools.gameManagers.store', $pool) }}">
                        @csrf
                        <button type="submit" class="btn btn-main startButton">Générer les matches</button>
                    </form>
                </div>
            @endif
        </div>
        @endforeach
@else
    <h3> stage {{ $stage }}</h3>
        @foreach ($tournament->getPoolsOfStage($tournament->id, $stage) as $pool)

        <div class="row">
            <div title="poule {{ $stage }}" class="col">{{ $pool->name }}
                <table id="" class="tableTeamList table table-bordered ">
                    <thead class="{{\App\Enums\PoolState::poolStateClassColor($pool->poolState)}}">
                    <tr>
                        <th title="Teams In" class="teamlist">
                            <a href="{{ route('tournaments.pools.show', [$tournament->id, $pool]) }}"> {{ $pool->poolName }} </a>
                            <br><a
                                class="poolHeader"> {{ \App\Enums\PoolState::poolStateName($pool->poolState) }}</a>
                            @php
                                $countPlayed = 0;
                                $countPlanned = 0;
                            @endphp
                            @foreach($pool->games as $keyGame =>  $game)
                                @if ($keyGame === 0)
                                    <br><a class="poolHeader">commence
                                        à {{ Carbon\Carbon::parse($game->start_time)->format('H:i') }}</a>
                                @endif
                                @if($game->score_contender1 !== null && $game->score_contender2 !== null)
                                    @php
                                        $countPlayed++;
                                    @endphp
                                @else
                                    @php
                                        $countPlanned++;
                                    @endphp
                                @endif
                            @endforeach

                            @if( $pool->poolState == 2)
                                <br><a class="poolHeader">jouée : {{ $countPlayed }}</a>
                                <br><a class="poolHeader"> plannifiée : {{ $countPlanned }}</a>
                            @endif
                        </th>
                        <th title="Teams Out" class="teamlist">Classement</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>@php
                                $allGamePlayed = false;
                            @endphp
                            @foreach($pool->games as $game)
                                @if($game->score_contender1 === null && $game->score_contender2 === null)
                                    @php
                                        $allGamePlayed = false;
                                    @endphp
                                @else
                                    @if($pool->poolState == 2)
                                        @php
                                            $allGamePlayed = true;
                                        @endphp
                                    @endif
                                @endif
                            @endforeach
                            <table id=""
                                class="table table-bordered teamlist tableStyle {{!$allGamePlayed ? $pool->poolState <= 1 ? "sortable" : "" : ""}}">

                                @php
                                    $teamName = "";
                                    $i = 1;
                                @endphp

                                {{-- Part of display for Visualisation to display name of team --}}

                                @foreach ($pool->contenders->sortBy('rank_in_pool') as $contender)
                                @if($contender->team_id == null)
                                    <tr>
                                        <td title="Team" class="team">
                                            <form
                                                action="{{ route('pools.contenders.update', [$pool, $contender]) }}"
                                                method="post">
                                                @csrf
                                                @method('put')
                                                <select onchange="this.form.submit()" name="team_id">
                                                    <option selected="true" disabled="disabled"> ---- </option>
                                                    @foreach ($tournament->getPoolsOfStage($tournament->id, $stage-1) as $poolPrevious)
                                                        @foreach ($poolPrevious->contenders->sortBy('rank_in_pool') as $contenderPrevious)

                                                            @if($contenderPrevious->team_id != null &&  !\App\Helpers\ContenderHelper::isSelected($pool, $contenderPrevious->team_id, $poolPrevious->id))
                                                                <option
                                                                    value="{{ $contenderPrevious->team_id}}"> {{ $contenderPrevious->rank_in_pool }}
                                                                    de {{ $poolPrevious->poolName }}</option>
                                                            @endif
                                                        @endforeach
                                                    @endforeach

                                                </select>
                                            </form>
                                        </td>

                                    </tr>
                                    @php $i++; @endphp
                                @else
                                    @foreach ($tournament->teams as $keyTeam => $team)
                                        @if ($team->name == \App\Helpers\ContenderHelper::contenderDisplayName($contender))
                                            @php $teamName = $team->name @endphp
                                            
                                            @if (\App\Helpers\ContenderHelper::isPoolClosed($contender))
                                            <tr>
                                                <td title="Team" class="team colorBackground"
                                                    data-previous="{{ $contender->previousId() }}">
                                                    <a>{{ \App\Helpers\ContenderHelper::contenderDisplayName($contender) }}</a>                                                                    
                                                </td>
                                            </tr>
                                            @else
                                            <tr>
                                                <td title="Team" class="team">
                                                    <a>{{ $contender->pool_from_rank }}
                                                        de {{ $contender->fromPool->poolName }}</a>
                                                </td>
                                            </tr>
                                            @endif

                                           
                                        @endif                                                
                                    @endforeach
                                @endif
                            @endforeach

                            </table>
                        </td>
                        <td>
                            <table id="" class="table table-bordered teamlist tableStyle">
                                @for ($i = 1; $i <= $pool->poolSize; $i++)
                                    <tr>
                                        <td title="Team" class="rank teamlist"
                                            id="{{ $pool->id.'-'.$i }}">{{ $i }}</td>
                                    </tr>
                                @endfor
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="btn-toolbar" >
            @if (Gate::allows('isOrg') && $pool->areAllGamesPlayed())
                <div class="col">
                    <a href="{{ route('tournaments.pools.close', $pool) }}" class="btn btn-main closeButton">
                        Terminer la pool
                    </a>
                </div>
            @endif
            @if ($pool->allowMatchesGeneration())
                <div class="col">
                    <form name="generate-matches" method="post" action="{{ route('pools.gameManagers.store', $pool) }}">
                        @csrf
                        <button type="submit" class="btn btn-main startButton">Générer les matches</button>
                    </form>
                </div>
            @endif
        </div>
        @endforeach
@endif