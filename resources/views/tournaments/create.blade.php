@extends('layout')

@section('content')

    <div class="col-6">
        <form action="{{ route('events.tournaments.store', $event->id) }}" method="POST">
            @csrf
            <div class="form-group row">
                <div class="col-6">
                    <label for="tournamentName">Nom du tournoi</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="col-6">
                    <label for="sportSelect">Sport</label>
                    <select class="form-control" id="sportSelect" name="sport_id">
                        <option>-- Choisissez --</option>
                        @foreach ($sports as $sport)
                            <option value="{{ $sport->id }}">{{ $sport->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-6">
                    <label for="tournamentSelect">Précédents tournois</label>
                    <select class="form-control" id="tournamentSelect" name="tournament_id">
                        <option data-choose="0">-- Choisissez --</option>
                        @foreach ($tournaments as $tournament)
                            <option class="d-none" data-sport="{{ $tournament->sport->id }}" value="{{ $tournament->id }}">{{ $tournament->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6">
                    <label>Copier le précédents tournois </label>
                    <button type="submit"  class="btn btn-main" style="width: 100%">Copier</button>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-6">
                    <label for="start_date">Date de début</label>
                    <input type="date" class="form-control col-m-6" name="start_date" id="start_date">
                </div>

                <div class="col-6">
                    <label for="start_hour">Heure de début</label>
                    <input type="time" class="form-control col-m-6" name="start_hour" id="start_hour">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="end_date">Date de fin</label>
                        <input type="date" class="form-control" name="end_date" id="end_date">
                    </div>
                </div>

                <div class="col-6">
                    <label for="end_hour">Heure de fin</label>
                    <input type="time" class="form-control col-m-6" name="end_hour" id="end_hour">
                </div>
            </div>

            <div class="form-group">
                <label for="max_teams">Nombre d'équipes</label>
                <input type="number" class="form-control" id="max_teams" name="max_teams" min="1" max="99999999999">
            </div>
            <button type="submit" name="action" value="save" class="btn btn-main">Créer</button>
        </form>
    </div>

<script src="{{ asset('js/tournamentDuplication.js') }}">

</script>
@stop
