@extends('layout')

@section('content')

<div class="col-6">
    <form action="{{ route('tournaments.teams.store', $tournament) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nom de l'équipe</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <button type="submit" class="btn btn-main">Créer</button>
    </form>
</div>

@stop
