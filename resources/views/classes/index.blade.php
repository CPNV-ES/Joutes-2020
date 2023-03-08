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
                            <th scope="col">Status</th>

                            <th scope="col">
                                <button type="submit" class="btn btn-main growIcon btnSynchroniser ">
                                    Synchroniser
                                </button>
                            </th>
                            <th scope="col">
                                <button type="button" class="btn btn-main growIcon" id="checkAll"><span>Check All</span></button>
                                <button type="button" class="btn btn-main growIcon" style="display: none" id="uncheckAll"><span>Uncheck All</span></button>
                            </th>


                        </thead>
                        <tbody>
                        @forelse($classes as $class)
                            <tr class="{{!$class['status']?'table-danger':($class['status']=='null'?'table-success':'table-secondary')}}">
                                <td>{{$class['name']}}</td>
                                <td>{{$class['year']}}</td>
                                <td>{{$class['holder']}}</td>
                                <td>{{$class['delegate']}}</td>
                                <td id="{{$class['name']}}">{{!is_null($class['status'])?'Non syncronisé':$class['status']}}</td>
                                <td colspan="2"><input class="col-lg-12 synchroniser classesboxes" name="{{$class['name']}}"
                                                       type="checkbox" {{$class['status']=='null'? 'checked':''}}></td>
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


