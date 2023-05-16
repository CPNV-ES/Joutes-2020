@extends('layout')
@section('content')
<h1>Hello World</h1>
<table style="width: 100%;">
    <thead>
        <tr>
            <th colspan="3" style="text-align: center;">Unregistered required users</th>
        </tr>
    </thead>
    <tbody>
        @foreach($requiredUnregisteredUsers as $user)
        <tr>
            <td>{{ $user->last_name }}</td>
            <td>{{ $user->first_name }}</td>
            <td><a href="mailto:{{$user->email}}">{{ $user->email }}</a></td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3" style="text-align: center;"><a href="mailto:?bcc=@foreach($requiredUnregisteredUsers as $user){{ $user->email }};@endforeach">Send email to all</a></th>
        <tr>
    </tfoot>
</table>
@stop