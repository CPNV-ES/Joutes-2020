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

                    <div class="form-group">
                        <label for="start_date">Date de début</label>
                        <input type="text" class="form-control" id="start_date" name="start_date" aria-describedby="startDateHelp">
                        <small id="startDateHelp" class="form-text text-muted">Doit être formatté comme suit : JJ/MM/AAAA
                            hh:mm</small>
                    </div>

                    <div class="form-group">
                        <label for="end_date">Date de fin</label>
                        <input type="text" class="form-control" id="end_date" name="end_date" aria-describedby="endDateHelp">
                        <small id="endDateHelp" class="form-text text-muted">Doit être formatté comme suit : JJ/MM/AAAA
                            hh:mm</small>
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