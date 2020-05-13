@extends('layout')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-1 ml-n5">
                <a href="{{ route('tournaments.show', $tournament) }}"><i class="fa fa-4x fa-arrow-circle-left return fa-return growIcon" aria-hidden="true"></i></a>
            </div>
            <div class="col-11 ml-n2">
                <h1>{{ $tournament->name }}</h1>
                <hr>
            </div>
        </div>

        <div class="stages-container">
            <div class="stage">
                <div class="pools-container">
                    <div class="editForm col-6">
                        <form action="{{ route('tournaments.update', $tournament) }}" method="post">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                <label for="name">Nom du tournoi</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $tournament->name }}">
                            </div>
                            <div class="form-group row">
                                <div class="col-6">
                                    <label for="start_date">Date de début</label>
                                    <input type="date" class="form-control col-m-6" name="start_date" id="start_date" value="{{ $tournament->start_date->format('Y-m-d') }}">
                                </div>

                                <div class="col-6">
                                    <label for="start_hour">Heure de début</label>
                                    <input type="time" class="form-control col-m-6" name="start_hour" id="start_hour" value="{{ $tournament->start_date->format('H:i') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="end_date">Date de fin</label>
                                        <input type="date" class="form-control" name="end_date" id="end_date" value="{{ $tournament->end_date->format('Y-m-d') }}">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label for="end_hour">Heure de fin</label>
                                    <input type="time" class="form-control col-m-6" name="end_hour" id="end_hour" value="{{ $tournament->end_date->format('H:i') }}">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="sport">Sport</label>
                                <select class="form-control" id="sport" name="sport_id">
                                    @foreach ($sports as $sport)
                                        @if ($tournament->sport->name == $sport->name)
                                            <option value="{{ $sport->id }}" selected>{{ $sport->name }}</option>
                                        @else
                                            <option value="{{ $sport->id }}">{{ $sport->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="max_teams">Nombre d'équipes</label>
                                <input type="number" class="form-control" name="max_teams" id="max_teams" value="{{ $tournament->max_teams }}">
                            </div>
                            <button type="submit" class="btn btn-main">Sauvegarder</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
