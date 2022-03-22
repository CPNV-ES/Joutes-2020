@extends('layout')

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-1 ml-n5">
                <a href="{{ route('tournaments.show', $tournament) }}"><i
                        class="fa fa-4x fa-arrow-circle-left return fa-return growIcon" aria-hidden="true"></i></a>
            </div>

            <div class="col-11 ml-n2">
                <h1 class="tournamentName">
                    {{ $team->name }}
                </h1>
                <hr>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-6">
                <table id="" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Utilisateur</th>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>email</th>
                            <th>Capitain</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($members as $member)
                        <tr>
                            <td>{{$member->user->username}}</td>
                            <td>{{$member->user->first_name}}</td>
                            <td>{{$member->user->last_name}}</td>
                            <td>{{$member->user->email}}</td>
                            <td>{{$member->isCaptain}}</td>
                        </tr>
                    @empty
                        <tr>
                            <td>Aucune équipe pour l'instant ...</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

        </div>

    </div>

    <script src="{{ asset('js/tournamentView.js') }}"></script>
@stop
