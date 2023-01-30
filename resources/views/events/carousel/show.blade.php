@extends('layout')
@section('content')
    @push('carousel')
        <script src="{{ asset('/js/carousel.js') }}"></script>
    @endpush

    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="display-1">
                    {{ $event->name }}
                </h1>

                <hr>
            </div>
        </div>

        <div id="carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($tournaments as $tournament)
                    <script>alert('BUG LARAVEL 9.0 $loop')</script>
                    <div class="carousel-item @if ($loop->first) active @endif width 100% ">
                        <div class="border border-success" style="border-primary">
                            <div class="text-center" style="width: 100%!important">
                                <div>
                                    <h1 class="display-1">
                                        {{ $tournament->name }}
                                    </h1>
                                    <div>
                                        @foreach ($tournament->poolsReady() as $pool)
                                            <!--show name and state of the pool-->
                                            <div class="text-center" style="width: 100%!important">
                                                <div>
                                                    <div class="" style="background-color: #212121 ">
                                                        <h4 class="card-title display-3">
                                                            {{ $pool->toArray()['poolName'] }}
                                                        </h4>
                                                        <p class="card-text display-4">
                                                            <!--get pool state from the enum-->
                                                            {{ \App\Enums\PoolState::poolStateName($pool->toArray()['poolState']) }}
                                                        </p>
                                                    </div>
                                                    <!--show in a table the pools games With Scores-->
                                                    <table class="table table-striped">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col">
                                                                <div class="display-4">Début</div>
                                                            </th>
                                                            <th scope="col" class="display-4">
                                                                <div class="display-4">Equipe</div>
                                                            </th>
                                                            <th scope="col" class="display-4">
                                                                <div class="display-4">Terrain</div>
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($pool->gamesWithoutScores as $match)
                                                            @if ($match->isLate())
                                                                <tr
                                                                    style="background-color : rgb(194, 111, 111)!important">
                                                            @else
                                                                <tr>
                                                                    @endif

                                                                    <td class="display-4">
                                                                        <h2>
                                                                            {{ $match->start_time }}
                                                                        </h2>
                                                                    </td>
                                                                    <td>
                                                                        <h2>
                                                                            @if ($match->team1() == null)
                                                                                {{ $match->contender1->rank_in_pool . ($match->contender1->rank_in_pool == 1 ? 'er ' : 'ème ') . 'de ' . $match->contender1->fromPool->poolName }}
                                                                            @else
                                                                                {{ $match->team1()->toArray()['name'] }}
                                                                            @endif
                                                                            VS
                                                                            @if ($match->team2() == null)
                                                                                {{ $match->contender2->rank_in_pool . ($match->contender2->rank_in_pool == 1 ? 'er ' : 'ème ') . 'de ' . $match->contender2->fromPool->poolName }}
                                                                            @else
                                                                                {{ $match->team2()->toArray()['name'] }}
                                                                            @endif
                                                                        </h2>
                                                                    </td>
                                                                    <td>
                                                                        <h2>
                                                                            {{ $match->court->name }}
                                                                        </h2>
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@stop
