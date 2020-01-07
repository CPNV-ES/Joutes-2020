@extends('layout')

@section('content')
    <div class="container">
        <form action="{{ route('tournaments.store') }}" method="POST">
            {{ csrf_field() }}
            <input type="text" name="name" placeholder="name" class="form-control">
            <input type="datetime-local" name="start_date" placeholder="start_date" class="form-control">
            <input type="datetime-local" name="end_date" placeholder="end_date" class="form-control">
            <input type="text" name="img" placeholder="img" class="form-control">
            <input type="text" name="max_teams" placeholder="max_teams" class="form-control">
            <input type="text" name="event_id" placeholder="event_id" class="form-control">
            <input type="text" name="sport_id" placeholder="sport_id" class="form-control">
            <button type="submit" class="btn btn-info">Submit</button>
        </form>
    </div>
@stop
