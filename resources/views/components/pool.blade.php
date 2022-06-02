<div class="row">
    <div title="poule {{ $stage }}" class="col">{{ $pool->name }}
        <table class="tableTeamList table table-bordered ">
            <thead class="{{ \App\Enums\PoolState::poolStateClassColor($pool->poolState) }}">
                <tr>
                    <th title="Teams In" class="teamlist">
                        <a href="{{ route('tournaments.pools.show', [$tournament->id, $pool]) }}">
                            {{ $pool->poolName }} </a>
                        <br><a class="poolHeader">
                            {{ \App\Enums\PoolState::poolStateName($pool->poolState) }}</a>
                        @php
                            $countPlayed = 0;
                            $countPlanned = 0;
                        @endphp
                        @foreach ($pool->games as $keyGame => $game)
                            @if ($keyGame === 0)
                                <br><a class="poolHeader">commence
                                    à
                                    {{ Carbon\Carbon::parse($game->start_time)->format('H:i') }}</a>
                            @endif
                            @if ($game->score_contender1 !== null && $game->score_contender2 !== null)
                                @php
                                    $countPlayed++;
                                @endphp
                            @else
                                @php
                                    $countPlanned++;
                                @endphp
                            @endif
                        @endforeach

                        @if ($pool->poolState == 2)
                            <br><a class="poolHeader">jouée : {{ $countPlayed }}</a>
                            <br><a class="poolHeader"> plannifiée :
                                {{ $countPlanned }}</a>
                        @endif
                    </th>
                    <th title="Teams Out" class="teamlist">Classement</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <table title="Teams In"
                            class="table table-bordered teamlist tableStyle {{ !$pool->areAllGamesPlayed() ? ($pool->poolState <= 1 ? 'sortable' : '') : '' }}">
                            @if ($poolState == 1)

                                @foreach ($pool->contenders->sortBy('rank_in_pool') as $contender)
                                    @foreach ($tournament->teams as $team)
                                        @if ($team->name == \App\Helpers\ContenderHelper::contenderDisplayName($contender))
                                            <tr>
                                                <td title="Team" class="team colorBackground"
                                                    id="{{ $contender->previousId() }}">
                                                    <a>{{ \App\Helpers\ContenderHelper::contenderDisplayName($contender) }}</a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            @else
                                @php
                                    $teamName = '';
                                    $i = 1;
                                @endphp

                                {{-- Part of display for Visualisation to display name of team --}}

                                @foreach ($pool->contenders->sortBy('rank_in_pool') as $contender)
                                    @if ($contender->team_id == null)
                                        <tr>
                                            <td title="Team" class="team">
                                                <a>{{ $contender->rank_in_pool }}
                                                    de {{ $contender->fromPool->poolName }}</a>
                                            </td>
                                        </tr>
                                        @php $i++; @endphp
                                    @else
                                        @foreach ($tournament->teams as $keyTeam => $team)
                                            @if ($team->name == \App\Helpers\ContenderHelper::contenderDisplayName($contender))
                                                @php $teamName = $team->name @endphp

                                                <tr>
                                                    <td title="Team" class="team colorBackground"
                                                        data-previous="{{ $contender->previousId() }}">
                                                        <a>{{ \App\Helpers\ContenderHelper::contenderDisplayName($contender) }}</a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        @foreach ($tournament->teams as $keyTeam => $team)
                                            @if ($team->name != \App\Helpers\ContenderHelper::contenderDisplayName($contender))
                                                @if (\App\Helpers\ContenderHelper::contenderDisplayName($contender) != $teamName)
                                                    @if ($keyTeam === 0)
                                                        <tr>
                                                            <td title="Team" class="team "
                                                                data-previous="{{ $contender->previousId() }}">
                                                                {{ \App\Helpers\ContenderHelper::contenderDisplayName($contender) }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        </table>
                    </td>
                    <td>
                        <table title="Teams Out" class="table table-bordered teamlist tableStyle">
                            @for ($i = 1; $i <= $pool->poolSize; $i++)
                                <tr>
                                    <td title="Team" class="team" id="{{ $pool->id . '-' . $i }}">
                                        {{ $i }}
                                    </td>
                                </tr>
                            @endfor
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


</div>
<div class="row">

    @if (Gate::allows('isOrg') && $pool->areAllGamesPlayed())
        <div class="col">
            <a href="{{ route('tournaments.pools.close', $pool) }}" class="btn btn-main closeButton">
                Terminer la pool
            </a>
        </div>
    @endif
    @if (Gate::allows('isOrg') && $pool->poolState == \App\Enums\PoolState::Prep && $pool->tournament->event->isPrepOrRegistered())
        <div class="col">
            <a href="" class="btn btn-main startButton">
                Générer les matches
            </a>
        </div>
    @endif
</div>
