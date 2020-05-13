@extends('layout')

@section('content')

    <div class="container">

        <div class="row mb-4">
            <div class="col-1 ml-n5">
                <a href="{{ route('administrations.index') }}"><i class="fa fa-4x fa-arrow-circle-left return fa-return growIcon" aria-hidden="true"></i></a>
            </div>

            <div class="col-11 ml-n2">
                <div class="row">
                    <div class="col-8">
                        <h1>Terrains</h1>
                    </div>    
                    <div class="col-4 pt-2">
                        <button type="button" class="btn btn-main" onclick="location.href='{{ route('courts.create') }}'">
                            Ajouter un terrain
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
                                        <a href="{{ route('courts.edit', $court->id)}}" title="Éditer le terrain" class="edit" style="margin-right: 10%;">
                                            <i class="fas fa-edit fa-lg" aria-hidden="true"></i>
                                        </a>
                                    
                                        <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
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

@stop


@section('pageSpecificJs')

    <script src="{{ asset('js/tables.js') }}"></script>

@stop
