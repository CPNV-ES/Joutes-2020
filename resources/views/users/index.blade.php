<!-- @author William Hausmann -->
@extends('layout')

@section('content')
    <script src='lib/datatables/min/jquery.dataTables.min.js'></script>
    <script src='lib/datatables/js/dataTables.bootstrap4.min.js'></script>
    <script src="lib/datatables/js/dataTables.responsive.min.js"></script>
    <script src="lib/datatables/js/dataTables.responsive.bootstrap4.min.js"></script>
    <link rel='stylesheet' href='lib/datatables/css/dataTables.bootstrap4.min.css'/>
    <link rel="stylesheet" href="lib/datatables/css/dataTables.responsive.bootstrap4.min.css">
    <div class="container">
        <table id="persons"  class="display nowrap" style="width:100%" >
            <thead>
            <tr>
                <th>Nom d'utilisateur</th>
                <th>Rôle</th>
                <th>Participations</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->username}}</td>
                    <td>{{$user->Role->name}}</td>
                    <td>Aucunes</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            $('#persons').DataTable({
                responsive: true
            });
        } );
    </script>
@stop



