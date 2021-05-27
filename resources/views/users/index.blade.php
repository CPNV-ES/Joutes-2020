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
    <style>
        table.dataTable tbody tr.selected   {
            background-color: #d33333 !important;
            color: white !important;
        }

        table.dataTable  tr.selected .sorting_1 {
            background-color: #d33333 !important;
            color: white !important;
        }
    </style>
    <div class="container">
        <form method="POST">
            @csrf
            <input type="hidden" name="_method" value="PUT">
        <table id="persons"  class="display nowrap" style="width:100%" >
            <thead>
            <tr>
                <th></th>
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
                            <input id="{{$user->id}}" type="checkbox"> Suppression
                        @endif
                    </td>
                    <td>
                        {{$user->username}}</td>
                    <td>{{$user->Role->name}}</td>
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
    <script>
        $(document).ready(function() {
            $('#persons').DataTable({
                responsive: true,
                "pageLength": 15
            });

            $('#persons tbody').on( 'click','input', function () {
                let userId = $(this).attr('id')
                let input = $('input[name="deletedUserId"]')
                $(this).closest("tr").toggleClass('selected')

                if (input.length) {
                    input.remove()
                }
                else{
                    let inputDeleted = $(document.createElement('input'))
                        .attr("type", "hidden")
                        .attr("name", "deletedUserId")
                        .attr("value", userId)
                    $(this).closest("tr").append(inputDeleted)
                }

            } );
        } );
    </script>
@stop



