@extends('layout')

@section('content')

    <div class="container">

        <div class="row mb-4">
            <div class="col-1 ml-n5">
                <a href="{{ route('events.index') }}"><i class="fa fa-4x fa-arrow-circle-left return fa-return growIcon" aria-hidden="true"></i></a>
            </div>

            <div class="col-11 ml-n2">
                <div class="row">
                    <div class="col-8">
                        <h1>Terrains</h1>
                    </div>
                    <div class="col-4 pt-2">
                        <button type="button" class="btn btn-main" onclick="location.href='{{ route('courts.create') }}'">
                            <i class="fa fa-plus fa-1x" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                <hr>
            </div>
        </div>

		<div class="row ml-4">
			<div class="col-10">
				<table id="roles-table" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Sport</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Abréviation</th>
							<th scope="col"><i class="fa fa-pencil" aria-hidden="true"></i></th>
						</tr>
					</thead>
					<tbody>
                        @foreach ($courts as $court)
                            <tr>
                                <td scope="row">{{$court->id}}</td>
                                <td>{{$court->sport->name}}</td>
                                <td>{{$court->name}}</td>
                                <td>{{$court->acronym}}</td>
                                <td style="font-size:16px;">
                                    <div class="row text-center justify-content-center">
                                        <a href="{{ route('courts.edit', $court->id)}}" title="Éditer le terrain" class="btn btn-main edit" style="margin-right: 10%;">
                                            <i class="fas fa-edit fa-lg" aria-hidden="true"></i>
                                        </a>

                                        <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                                            <i class="fa fa-trash fa-lg" aria-hidden="true"></i>
                                        </button>

                                    </div>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <i class="fas fa-times-circle fa-4x" style="color: red;"></i>
                    <h5 class="modal-title pl-3 pt-3" id="deleteModalLabel">Souhaitez-vous vraiment le supprimer ?</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <form action="{{ route('courts.destroy', $court->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop


@section('pageSpecificJs')

    <script src="{{ asset('js/tables.js') }}"></script>

@stop
