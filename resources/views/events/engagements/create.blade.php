@extends('layout')

@section('content')

    <div class="row">
        <div class="col-1 ml-n5">
            <a href="{{ route('events.show', $event) }}"><i class="fa fa-4x fa-arrow-circle-left return fa-return growIcon"
                                                            aria-hidden="true"></i></a>
        </div>
        <div class="col-11 ml-n2">
            <h1>S'insrire à
                {{ $event->name }}</h1>

            <hr>
        </div>
    </div>
    <div class="container">

        <div class="col-8">
            <form action="{{ route('events.eventRoleUsers.store', $event) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="tournamentName">Veuillez sélectionner le rôle pour cet événement (notez qu'un seul rôle
                                                pourra être choisi).</label>
                    <select class="form-control" name="engagement">
                        @foreach (\App\Models\Role::availableForEngagement()->get() as $engagement)
                            <option value="{{ $engagement->slug }}">{{ $engagement->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-main">Créer</button>
            </form>
        </div>
    </div>
@stop
