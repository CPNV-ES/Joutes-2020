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
                    <div class="col-9">
                        <h1>Ajouter un Evenements</h1>
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
                <form action="{{ route('events.store')  }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nom</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Ajouter un nom">
                    </div>
                    <input name="picture" type="file"  accept="image/png, image/jpeg " />
                    <button type="submit" class="btn btn-main">Ajouter</button>
                </form>

			</div>
		</div>

    </div>

@stop
