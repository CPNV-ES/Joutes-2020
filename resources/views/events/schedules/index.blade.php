@extends('layout')
@section('content')

    {!! $calendar->calendar() !!}
    {!! $calendar->script() !!}

@stop
