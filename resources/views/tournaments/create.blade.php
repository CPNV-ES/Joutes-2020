<div class="modal fade" id="createTournamentModal" tabindex="-1" role="dialog" aria-labelledby="createTournamentModal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Création d'un tournoi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('tournaments.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tournamentName">Nom du tournoi</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>

                    <div class="form-group row">
                        <div class="col-6">
                            <label for="start_date">Date de début</label>
                            <input type="date" class="form-control col-m-6" name="start_date" id="start_date">
                        </div>

                        <div class="col-6">
                            <label for="start_hour">Heure de début</label>
                            <input type="time" class="form-control col-m-6" name="start_hour" id="start_hour" step="1">
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
                            <input type="time" class="form-control col-m-6" name="end_hour" id="end_hour" step="1">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="sportSelect">Sport</label>
                        <select class="form-control" id="sportSelect" name="sport_id">
                            @foreach ($sports as $sport)
                                <option value="{{ $sport->id }}">{{ $sport->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <input type="hidden" id="event_id" name="event_id" value="{{ $event->id }}">

                    <div class="form-group">
                        <label for="max_teams">Nombre d'équipes</label>
                        <input type="number" class="form-control" id="max_teams" name="max_teams" min="1" max="99999999999">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-main">Créer</button>
                </div>
            </form>
        </div>
    </div>
</div>