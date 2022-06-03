@extends('layout')
@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <h1>
                    Tournois de l'évenement : {{ $event->name }}
                </h1>

                <hr>
            </div>
        </div>

        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($tournaments as $tournament)
                    <div class="carousel-item @if ($loop->first) active @endif width 100% ">
                        <div class="">
                            <div class="card text-center" style="width: 100%!important">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        {{ $tournament->name }}
                                    </h5>
                                    <div class="card-body">

                                        {{ $tournament->description }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
@stop
