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
                        <h1>Éditer un terrain</h1>
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
        
                <form action="{{ route('courts.update', $court) }}" method="post">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <label for="sport">Sport</label>
                    <select class="form-control" id="sport" name="sport_id">
                        @foreach ($sports as $sport)
                            @if ($sport->name == $court->sport->name)
                                <option value="{{ $sport->id }}" selected>{{ $sport->name }}</option>
                            @else
                                <option value="{{ $sport->id }}">{{ $sport->name }}</option>
                            @endif
                        @endforeach
                    </select>

                    <div class="form-group">
                        <label for="name">Nom</label>
                        <input type="text" class="form-control" name="name" placeholder="Nouveau nom" value="{{ $court->name }}">
                    </div>
                    <div class="form-group">
                        <label for="acronym">Abréviation</label>
                        <input type="text" class="form-control" name="acronym" placeholder="Nouvelle abréviation" value="{{ $court->acronym }}">
                    </div>
                    <button type="submit" class="btn btn-main">Éditer</button>
                </form>
			</div>
		</div>

    </div>

@stop
