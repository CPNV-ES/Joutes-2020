<!-- @author Yvann Butticaz -->
@extends('layout')

@section('content')

    <div class="container">

        <div class="row mb-4">
            <div class="col-1 ml-n5">
                <a href="{{ route('administrations.index') }}"><i class="fa fa-4x fa-arrow-circle-left return fa-return growIcon" aria-hidden="true"></i></a>
            </div>

            <div class="col-11 ml-n2">
                <h1>Rôles</h1>
                <hr>
            </div>
        </div>

		<div class="row ml-4">
			<div class="col-12">
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
                                <td class="text-center" style="font-size:16px;">

                                    <a href="{{ route('roles.edit', $role->id)}}" title="Éditer le role" class="edit" style="margin-right: 10%;">
                                        <i class="fas fa-edit fa-lg" aria-hidden="true"></i>
                                    </a>

                                    <form action="" method="POST">
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-trash fa-lg" aria-hidden="true"></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop


@section('pageSpecificJs')

    <script src="{{ asset('js/tables.js') }}"></script>

@stop
