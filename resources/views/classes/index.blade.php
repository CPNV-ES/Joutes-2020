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
            <div class="col-lg-12">
                <table id="" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th scope="col">classes</th>
                        <th scope="col">year</th>
                        <th scope="col">titulaire</th>
                        <th scope="col">délégué</th>
                        <th scope="col">status</th>

                    </tr>
                    </thead>
                    <tbody>
                    @forelse($classes as $class)
                        <tr class="{{!$class['status']?'table-danger':($class['status']==='synchronisé'?'table-success':'table-secondary')}}">
                            <td>{{$class['name']}}</td>
                            <td>{{$class['year']}}</td>
                            <td>{{$class['holder']}}</td>
                            <td>{{$class['delegate']}}</td>
                            <td>{{$class['status']?$class['status']:'inexistant'}}</td>
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
