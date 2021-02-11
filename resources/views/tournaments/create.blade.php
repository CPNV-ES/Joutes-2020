@extends('layout')

@section('content')

<div class="col-6">
    <form action="{{ route('events.tournaments.store', $event->id) }}" method="POST">
        @csrf
        <div class="form-group row">
            <div class="col-6">
                <label for="tournamentName">Nom du tournoi</label>
                <input type="text" class="form-control" id="tournamentName" name="name">
            </div>
            <div class="col-6">
                <label for="sportSelect">Sport</label>
                <select class="form-control" id="sportSelect" name="sportSelect" onchange="selection();" name="sport_id">
                    <option value="Choose">-- Choisissez --</option>
                    @foreach ($sports as $sport)
                        <option value="{{ $sport->id }}">{{ $sport->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <form id="FormCopy" action="{{ route('events.tournaments.copy', $event->id) }}" method="POST">
        <div class="form-group row">
            <div class="col-6">
                <label for="tournamentSelect">Précédents tournois</label>
                <select class="form-control" id="tournamentSelect" name="tournament_id">
                    <option>-- Choisissez --</option>
                </select>
            </div>
            <div class="col-6">
                <label>Copier le précédents tournois </label>
                <button type="submit" form="FormCopy"  class="btn btn-main" style="width: 100%">Copier</button>
            </div>
        </div>
        </form>
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
        <button type="submit" class="btn btn-main">Créer</button>
    </form>
</div>

<script>
    var tournaments = {!! json_encode($tournaments ) !!}
    console.log(tournaments);
    function selection() {
        var liste = document.getElementById('sportSelect');
        var valeur = liste.options[liste.selectedIndex].value;
        console.log(tournaments[0].name);



        var catOptions = "";
        if(valeur == "Choose"){
            catOptions += "<option>--- Choisissez ---</option>";
            document.getElementById("tournamentSelect").innerHTML = catOptions;
        }
        else {
            for (i = 0; i < tournaments.length; i++) {

                if (tournaments[i].sport_id == valeur) {

                    console.log(tournaments[i].sport_id);
                    console.log(valeur);

                    console.log('Its ok')

                    catOptions += "<option value='" + tournaments[i].id + "' >" + tournaments[i].name + "</option>";
                }
            }
            document.getElementById("tournamentSelect").innerHTML = catOptions;
        }
    }

</script>
@stop
