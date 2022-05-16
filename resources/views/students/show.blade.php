@extends('layout')

@section('content')
    <div class="container">

        <div class="row">

            <div class="col-11 ml-n2">
                <h1 class="tournamentName">
                    Liste des éleves
                </h1>
                <hr>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-12">
                <table id="" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Classe</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($studentsList as $student)
                            <tr>
                                <td>{{ $student->lastname }}</td>
                                <td>{{ $student->firstname }}</td>
                                <td>{{ $student->class }}</td>
                                <td>{{ $student->state }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>

@stop
