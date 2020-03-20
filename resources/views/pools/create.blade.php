@extends('layout')

@section('content')
  <div class="container">

    <div class="row">
      <div class="col-1 ml-n5">
      <a href="{{ route('tournaments.show', $tournament) }}"><i class="fa fa-4x fa-arrow-circle-left return fa-return growIcon" aria-hidden="true"></i></a>
      </div>
      <div class="col-11 ml-n2">
        <h1>Création d'une poule</h1>
        <hr>
      </div>
    </div>
    
    <div class="col-6">
      <form action="{{ route('tournaments.pools.store', $tournament) }}" method="post">
        @csrf
        <div class="form-group">
          <label for="poolName">Nom de la poule</label>
          <input type="text" class="form-control" id="poolName" name="poolName">
        </div>
  
        <div class="form-group row">
          <div class="col-6">
              <label for="start_time">Heure de début</label>
              <input type="time" class="form-control col-m-6" name="start_time" id="start_time" step="1">
          </div>

          <div class="col-6">
            <label for="end_time">Heure de fin</label>
            <input type="time" class="form-control col-m-6" name="end_time" id="end_time" step="1">
        </div>
        </div>
  
        <div class="form-group row">
          <div class="col-6">
            <div class="form-group">
              <label for="stage">Phase</label>
              <input type="number" class="form-control" id="stage" name="stage" min="1">
            </div>
          </div>
    
          <div class="col-6">
            <div class="form-group">
              <label for="poolSize">Taille</label>
              <input type="number" class="form-control" id="poolSize" name="poolSize" min="1">
            </div>
          </div>
        </div>
  
        <div class="form-group">
          <label for="mode_id">Mode</label>
            <select class="form-control" id="mode_id" name="mode_id">
              @foreach ($poolModes as $poolMode)
                <option value="{{ $poolMode->id }}">{{ $poolMode->mode_description }}</option>
              @endforeach
            </select>
        </div>
  
        <div class="form-group">
          <label for="game_type_id">Type</label>
            <select class="form-control" id="game_type_id" name="game_type_id">
              @foreach ($gameTypes as $gameType)
                <option value="{{ $gameType->id }}">{{ $gameType->game_type_description }}</option>
              @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-main">Créer</button>
      </form>
    </div>
  </div>
@endsection