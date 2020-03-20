<!-- @author Yvann Butticaz -->
@extends('layout')

@section('content')

    <div class="container">
        <div class="row mb-4">
            <div class="col-1 ml-n5">
                <a href="{{ route('events.index') }}"><i class="fa fa-4x fa-arrow-circle-left return fa-return growIcon" aria-hidden="true"></i></a>
            </div>

            <div class="col-11 ml-n2">
                <h1>Administration</h1>
                <hr>
            </div>
        </div>

		<div class="row ml-4">
            <a href="{{ route('roles.index') }}">
                <div class="card">
                    <img class="card-img" src="" alt="Image">
                    <div class="card-body">
                        <h5 class="card-title">Rôles utilisateurs</h5>
                    </div>
                </div>
            </a>
        </div>

    </div>

@stop



