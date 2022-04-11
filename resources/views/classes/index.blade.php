@extends('layout')

@section('content')
    <div class="container">

        <div class="row">

            <div class="col-11 ml-n2">
                <h1 class="tournamentName">
                    Sainte-Croix
                </h1>
                <hr>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-6">
                <table id="" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>classes</th>
                        <th>year</th>
                        <th>titulaire</th>
                        <th>délégué</th>
                        <th>status</th>

                    </tr>
                    </thead>
                    <tbody>
                    @forelse($classes as $class)
                        <tr>
                            <td>{{$class['name']}}</td>
                            <td>{{$class['year']}}</td>
                            <td>{{$class['holder']}}</td>
                            <td>{{$class['delegate']}}</td>
                            <td>{{$class['status']}}</td>
                        </tr>
                    @empty
                        <tr>
                            <td>Aucune classes pour l'instant ...</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

        </div>

    </div>
@stop
