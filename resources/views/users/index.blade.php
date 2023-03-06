<!-- @author William Hausmann -->
@extends('layout')

@section('content')
    <script src='lib/datatables/min/jquery.dataTables.min.js'></script>
    <script src='lib/datatables/js/dataTables.bootstrap4.min.js'></script>
    <script src="lib/datatables/js/dataTables.responsive.min.js"></script>
    <script src="lib/datatables/js/dataTables.responsive.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel='stylesheet' href='lib/datatables/css/dataTables.bootstrap4.min.css'/>
    <link rel="stylesheet" href="lib/datatables/css/dataTables.responsive.bootstrap4.min.css">
    <div class="container">
        <form action="{{route('classes.store')}}">
        <button type="submit" class="btn btn-main growIcon btnSynchroniser ">
            Synchroniser
        </button>
        </form>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <form method="POST" action="{{ route('users.destroy.all') }}">
            @csrf
            @method('DELETE')
            <table id="persons" class="display nowrap" style="width:100%">
                <thead>
                <tr>
                    <th id="deleteInput">
                        <input type="button" class="btn btn-danger d-none" value="Supprimer" data-toggle="modal"
                               data-target="#deleteModal"/>
                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                             aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <i class="fas fa-times-circle fa-4x" style="color: red;"></i>
                                        <h5 class="modal-title pl-3 pt-3" id="deleteModalLabel">Suppression</h5>

                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p id="deleteModalText"></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Annuler
                                        </button>
                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </th>
                    <th>Nom d'utilisateur / Nom + Prénom</th>
                    <th>Rôle</th>
                    <th>Participations</th>
                    <th>Équipes</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr class="user">
                        <td>
                            @if ($user->isDeletable())
                                <input value="{{ $user->id }}" type="checkbox">
                            @endif
                        </td>
                        <td>
                            {{ $user->username }} / {{ $user->last_name }} {{ $user->first_name }}</td>
                        <td>
                            <select name='{{ $user->id }}' @if(($user->role->slug == "ADMIN")&&(Auth::user()->username == $user->username)) disabled @endif class="form-control-sm rolesSelect">
                                @foreach ($roles as $role)

                                    <option  @if ($user->role->slug == $role->slug) selected @endif id={{ $role->id }}>
                                        {{ $role->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            @foreach ($user->events as $event)
                                <div class="p-2">
                                    {{ $event->name }}
                                    @if ($event->isRegisterOrReady())
                                        <select name='{{ Helper::EventRoleUser($user, $event)->id }}'
                                                data-event="{{ $event->id }}" class="form-control-sm engagementsSelect">
                                            @foreach (\App\Models\Role::availableForEngagement()->get() as $role)
                                                <option @if (Helper::EventRoleUser($user, $event)->role->slug == $role->slug) selected @endif
                                                id={{ $role->slug }}>
                                                    {{ $role->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @else
                                        <span class="form-control-sm select">{{ $role->name }}</span>
                                    @endif

                                </div>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($teams = $user->teams as $index => $team)
                                {{ $team->name }}@if ($index + 1 < $teams->count())
                                    ,
                                @endif
                            @endforeach
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </form>
    </div>
    <script src="{{ asset('js/dataTableUserPerms.js') }}"></script>
@stop
