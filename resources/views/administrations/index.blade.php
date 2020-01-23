<!-- @author Yvann Butticaz --> 
@extends('layout')

@section('content')

    <div class="container">
        <div class="row">
            <h1>Administration</h1>
        </div>
    
        <div class="row mt-5">
            <a href="{{ route('roles.index') }}">
                <div class="card card-center">
                    <h2><b>Rôles utilisateurs</b></h2>
                </div>
            </a>
        </div> 
        
    </div>

@stop