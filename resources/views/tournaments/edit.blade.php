@extends('layout')

@section('content')
    <div class="container">
        <h1>{{ $tournament->name }}</h1>
        <div class="stages-container">
            <div class="stage">
                @if(count($tournament->pools) > 0)
                    <h2>Phase 1</h2>
                    <div class="pools-container">
                        <div class="pool">
                            <button class="btn">Add pool</button>
                        </div>
                    </div>
                @else
                    <h2>Phase ttttt</h2>
                    <div class="pools-container">
                        <div class="pool">
                            <button class="btn">Add pool</button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@stop
