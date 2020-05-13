@extends('layout')

@section('content')

    <div class="container">

        <div class="row mb-4">
            <div class="col-1 ml-n5">
                <a href="{{ route('courts.index') }}"><i class="fa fa-4x fa-arrow-circle-left return fa-return growIcon" aria-hidden="true"></i></a>
            </div>

            <div class="col-11 ml-n2">
                <div class="row">
                    <div class="col-9">
                        <h1>Ajouter un terrain</h1>
                    </div>    
                </div>  
                <hr>
            </div>
        </div>


        @if ($errors->any())
			<div class="alert alert-danger">
	            @foreach ($errors->all() as $error)
	                {{ $error }}<br>
	            @endforeach
	        </div>
        @endif

        
		<div class="row ml-4">
			<div class="col-10">
        
                <form action="{{ route('courts.store') }}" method="post">
                    @csrf
                    <label for="sport">Sport</label>
                    <select class="form-control" id="sport" name="sport_id">
                        @foreach ($sports as $sport)
                            <option value="{{ $sport->id }}">{{ $sport->name }}</option>
                        @endforeach
                    </select>

                    <div class="form-group">
                        <label for="name">Nom</label>
                        <input type="text" class="form-control" name="name" placeholder="Nom">
                    </div>
                    <div class="form-group">
                        <label for="acronym">Abréviation</label>
                        <input type="text" class="form-control" name="acronym" placeholder="Abréviation">
                    </div>
                    <button type="submit" class="btn btn-main">Éditer</button>
                </form>
			</div>
		</div>

    </div>

@stop