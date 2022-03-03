@props(['trigger', 'route', 'parameters' => []])

<div class="modal fade" id="{{ $trigger }}" tabindex="-1" role="dialog"
    aria-labelledby="{{ $trigger }}Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <i class="fas fa-times-circle fa-4x" style="color: red;"></i>
                <h5 class="modal-title pl-3 pt-3" id="{{ $trigger }}Label">Êtes-vous sûr de vouloir faire ça?</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <form action="{{ route($route, $parameters) }}" method="POST">
                    @csrf
                    {{ method_field('PUT') }}
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-success">Ok !</button>
                </form>
            </div>
        </div>
    </div>
</div>
