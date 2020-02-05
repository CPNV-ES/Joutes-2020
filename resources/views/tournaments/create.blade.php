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
                        <input type="text" class="form-control" id="tournamentName">
                    </div>

                    <div class="form-group">
                        <label for="fromDate">Date de début</label>
                        <input type="text" class="form-control" id="fromDate" aria-describedby="fromDateHelp">
                        <small id="fromDateHelp" class="form-text text-muted">Doit être formatté comme suit : JJ/MM/AAAA
                            hh:mm</small>
                    </div>

                    <div class="form-group">
                        <label for="toDate">Date de fin</label>
                        <input type="text" class="form-control" id="toDate" aria-describedby="toDateHelp">
                        <small id="toDateHelp" class="form-text text-muted">Doit être formatté comme suit : JJ/MM/AAAA
                            hh:mm</small>
                    </div>

                    <div class="form-group">
                        <label for="sportSelect">Sport</label>
                        <select class="form-control" id="sportSelect">
                            @foreach ($sports as $sport)
                                <option value="{{ $sport->id }}">{{ $sport->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nrOfTeams">Nombre d'équipes</label>
                        <input type="number" class="form-control" id="nrOfTeams" min="1" max="99999999999">
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