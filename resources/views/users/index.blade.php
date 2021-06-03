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
        <form method="POST" action="{{ route('users.destroy.all')}}">
            @csrf
            @method('DELETE')
        <table id="persons"  class="display nowrap" style="width:100%" >
            <thead>
            <tr>
                <th id="deleteInput">
                    <input type="submit" class="btn btn-danger invisible" value="Supprimer"/>
                </th>
                <th>Nom d'utilisateur</th>
                <th>Rôle</th>
                <th>Participations</th>
                <th>Équipes</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr class="user">
                    <td>
                        @if($user->isDeletable())
                            <input id="{{$user->id}}" type="checkbox">
                        @endif
                    </td>
                    <td>
                        {{$user->username}}</td>
                    <td>
                        @if($user->username == Auth::user()->username)
                            {{$user->role->name}}
                        @else
                            <select class="form-control-sm">
                                @foreach($roles as $role)
                                    <option @if($user->role->slug == $role->slug) selected @endif id={{$role->id}}>{{$role->name}}</option>
                                @endforeach
                            </select>
                        @endif
                    </td>
                    <td>
                        Joutes :
                        @foreach($dates = $user->playedIn() as $index=>$date)
                            {{$date}}@if($index + 1 < count($dates)), @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach($teams = $user->teams as $index=>$team)
                            {{$team->name}}@if($index + 1 < $teams->count()), @endif
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



