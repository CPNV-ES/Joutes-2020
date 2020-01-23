@extends('layout')

@section('content')

    <div class="container">
        <h1>Tournoi de :</h1>
        <div class="text-center">
            <h2>Matchs et Résultats</h2>
            <h3>date</h3>
            <div class="row justify-content-center">
                <table class="table">
                    <tbody class="text">
                        <tr>
                            <div class="col-2 text-left">badboys</div>
                            <div class="col-1 text-right">6</div>
                            <div class="col-1">-</div>
                            <div class="col-1 text-left">10</div>
                            <div class="col-2 text-right">SuperNanas</div>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="text-center">
            <h2>Classement actuel</h2>
            <table class="table">
                <thead class="black white-text">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Équipes</th>
                    <th scope="col">Pts</th>
                    <th scope="col">G</th>
                    <th scope="col">P</th>
                    <th scope="col">N</th>
                    <th scope="col">+/-</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="col">1</th>
                    <th scope="col">supernana</th>
                    <th scope="col">6</th>
                    <th scope="col">3</th>
                    <th scope="col">0</th>
                    <th scope="col">0</th>
                    <th scope="col">23</th>
                </tr>
        </div>
    </div>
@stop
