<!-- @author Yvann Butticaz -->
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
                        <h1>Rôles</h1>
                    </div>
                    <div class="col-4 pt-2">
                        <button type="button" class="btn btn-main" onclick="location.href='{{ route('roles.create') }}'">
                            Ajouter un rôle
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
							<th scope="col">Id</th>
							<th scope="col">Slug</th>
							<th scope="col">Nom</th>
							<th scope="col"><i class="fa fa-pencil" aria-hidden="true"></i></th>
						</tr>
					</thead>
					<tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td scope="row">{{$role->id}}</td>
                                <td>{{$role->slug}}</td>
                                <td>{{$role->name}}</td>
                                <td style="font-size:16px;">
                                    <div class="row text-center justify-content-center">
                                        <a href="{{ route('roles.edit', $role->id)}}" title="Éditer le role" class="edit" style="margin-right: 10%;">
                                            <i class="fas fa-edit fa-lg" aria-hidden="true"></i>
                                        </a>
                                        @if($role->isUsed() == null)
                                            <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                                                <i class="fa fa-trash fa-lg" aria-hidden="true"></i>
                                            </button>
                                        @endIf

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
                <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
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
