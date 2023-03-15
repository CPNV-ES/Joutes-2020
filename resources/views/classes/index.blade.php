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
                <form action="{{ route('classes.store') }}" method="post"
                      title="Synchroniser le liste des classes"
                      onsubmit="return confirm('Vous êtes sûr de vouloir synchroniser la liste des classes. ?');">
                    @csrf
                    <table id="" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Classes</th>
                            <th scope="col">Year</th>
                            <th scope="col">Titulaire</th>
                            <th scope="col">Délégué</th>
                            <th scope="col">Mis à jour</th>
                            <th scope="col">
                                <button type="submit" class="btn btn-main growIcon btnSynchroniser ">
                                    Synchroniser
                                </button>
                            </th>


                        </thead>
                        <tbody>
                        @forelse($classes as $class)
                            <tr class="{{!$class['updated_at']?'table-danger':'table-success'}}">
                                <td>{{$class['name']}}</td>
                                <td>{{$class['year']}}</td>
                                <td>{{$class['holder']}}</td>
                                <td>{{$class['delegate']}}</td>
                                <td colspan="2" id="{{$class['name']}}">{{!is_null($class['updated_at'])?$class['updated_at']:'Non syncronisé'}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td>Aucune classes pour l'instant ...</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                </form>
    </div>
    <script src="{{ asset('js/classes.js') }}"></script>

@stop


