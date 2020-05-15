<!-- @author Yvann Butticaz --> 
@extends('layout')

@section('content')

    <div class="container">

        <div class="row mb-4">
            <div class="col-1 ml-n5">
                <a href="{{ route('roles.index') }}"><i class="fa fa-4x fa-arrow-circle-left return fa-return growIcon" aria-hidden="true"></i></a>
            </div>

            <div class="col-11 ml-n2">
                <div class="row">
                    <div class="col-9">
                        <h1>Ajouter un rôle</h1>
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
        
                <form action="{{ route('roles.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" name="slug" placeholder="Ajouter un slug">
                    </div>
                    <div class="form-group">
                        <label for="Nom">Nom</label>
                        <input type="text" class="form-control" name="name" placeholder="Ajouter un nom">
                    </div>

                    <button type="submit" class="btn btn-main">Ajouter</button>
                </form> 
			</div>
		</div>

    </div>

@stop