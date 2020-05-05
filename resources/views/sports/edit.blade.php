@extends('layout')

@section('content')


    <div class="row">
        <div class="col-1 ml-n5">
            <a href="{{ route('sports.index') }}"><i class="fa fa-4x fa-arrow-circle-left return fa-return growIcon" aria-hidden="true"></i></a>
        </div>
        <div class="col-11 ml-n2">
            <h1>Sports</h1>

            <hr>
        </div>
    </div>
    <div class="container">

        <div class="col-8">
            <form action="{{route('sports.update', $sports)}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="tournamentName">Sports</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{$sports->name}}">
                </div>

                <div class="form-group">
                    <label for="tournamentName">Description</label>
                    <input type="text" class="form-control" id="description" name="description" value="{{$sports->description}}">
                </div>

                <div class="form-group row">
                    <div class="col-6">
                        <label for="start_date">Min de participant</label>
                        <input type="number" class="form-control" id="min_teams" name="min_teams" min="1" max="99999999999" value="{{$sports->min_participant}}">
                    </div>

                    <div class="col-6">
                        <label for="start_hour">Max de participant</label>
                        <input type="number" class="form-control" id="max_teams" name="max_teams" min="1" max="99999999999" value="{{$sports->max_participant}}">
                    </div>
                </div>
                <button type="submit" class="btn btn-main">Edit</button>
            </form>
        </div>
    </div>
@stop
