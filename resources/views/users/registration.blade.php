@extends('layout')
@section('content')
<table style="width: 100%; border: solid gray 2px;">
    <thead>
        <tr>
            <th colspan="3" style="text-align: center; border: solid gray 2px;">Unregistered required users</th>
        </tr>
    </thead>
    <tbody>
        @foreach($requiredUnregisteredUsers as $user)
        <tr>
            <td style="border: solid gray 1px;">{{ $user->last_name }}</td>
            <td style="border: solid gray 1px;">{{ $user->first_name }}</td>
            <td style="border: solid gray 1px;"><a href="mailto:{{$user->email}}">{{ $user->email }}</a></td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3" style="text-align: center; border: solid gray 2px;"><a href="mailto:?bcc=@foreach($requiredUnregisteredUsers as $user){{ $user->email }};@endforeach">Send email to all</a></th>
        <tr>
    </tfoot>
</table>
@stop