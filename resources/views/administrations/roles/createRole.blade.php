<!-- @author Yvann Butticaz --> 
@extends('layout')

@section('content')

    <div class="container">

        <a href=""><i class="fa fa-4x fa-arrow-circle-left return" aria-hidden="true"></i></a>

        <h1 class="title">Créer un role</h1>


        @if ($errors->any())
			<div class="alert alert-danger">
	            @foreach ($errors->all() as $error)
	                {{ $error }}<br>
	            @endforeach
	        </div>
        @endif


        {{ Form::open(array('url' => route('roles.store'), 'method' => 'post', 'id' => 'formRole')) }}

            <div class="form-group">
                {{ Form::label('slug', 'Slug : ') }}
                {{ Form::text('slug', null, array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('name', 'Nom : ') }}
                {{ Form::text('name', null, array('class' => 'form-control')) }}
            </div>

            <div class="send">{{ Form::button('Enregistrer', array('class' => 'btn btn-success formSend')) }}</div>

		{{ Form::close() }}


    </div>




@stop


@section('pageSpecificJs')

    <script src="{{ asset('js/tables.js') }}"></script>

@stop