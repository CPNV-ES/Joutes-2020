@extends('layout')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-1 ml-n5">
                <a href="{{ route('events.index') }}"><i class="fa fa-4x fa-arrow-circle-left return fa-return growIcon"
                                                         aria-hidden="true"></i></a>
            </div>
            <div class="col-11 ml-n2">
                <h1>Sports <a href="{{ route('sports.create') }}" class="btn-create btn btn-main">
                        <i class="fa fa-plus fa-1x" aria-hidden="true"></i>
                    </a>
                </h1>


                <hr>
            </div>
        </div>

        <div class="col-12">
            <form action="" method="post">
                @csrf
                <div class="col-11 ml-n2">
                    <table class="table">
                        <thead class="black white-text">
                        <tr>
                            <th scope="col">Sports</th>
                            <th scope="col">Description</th>
                            <th scope="col">Min. de participant</th>
                            <th scope="col">Max. de participant</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($sports as $sport)
                            <tr data-id=" data-rank=">
                                <td>{{$sport->name}}</td>
                                <td>{{$sport->description}}</td>
                                <td>{{$sport->min_participant}}</td>
                                <td>{{$sport->max_participant}}</td>
                                <td>
                                    <a href="{{ route('sports.edit', $sport) }}" class="btn-edit btn btn-main">
                                        <i class="fa fa-edit fa-1x" aria-hidden="true"></i>
                                    </a>
                                    <button id="deleteBtn" class="btn btn-danger" type="button" data-toggle="modal"
                                            data-target="#stageSportModal">

                                        <i class="fa fa-trash fa-1x" aria-hidden="true"></i>
                                    </button>

                                </td>

                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="stageSportModal" tabindex="-1" role="dialog"
         aria-labelledby="stageSportModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <i class="fas fa-times-circle fa-4x" style="color: red;"></i>
                    <h5 class="modal-title pl-3 pt-3" id="stageSportModalLabel">Êtes vous sûr de
                        vouloir le supprimer ?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-footer">
                    <form action="{{ route('sports.destroy', $sport) }}" method="POST">
                        @csrf
                        {{ method_field('DELETE') }}
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Annuler
                        </button>
                        <button type="submit" class="btn btn-success">Ok !</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop



