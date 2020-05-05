@extends('layout')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-1 ml-n5">
                <a href="{{ route('events.index') }}"><i class="fa fa-4x fa-arrow-circle-left return fa-return growIcon" aria-hidden="true"></i></a>
            </div>
            <div class="col-11 ml-n2">
                <h1>Sports <a href="{{ route('sports.create') }}" class="btn-create"><input type="button" class="btn btn-main grow" value="Create"></a></h1>

                <hr>
            </div>
        </div>

        <div class="col-12">
            <form action="" method="post">
                @csrf
                <div class="col-11 ml-n2">
                    <table class="table">
                        <thead class="black white-text">
                        <tr>
                            <th scope="col">Sports</th>
                            <th scope="col">Description</th>
                            <th scope="col">Min. de participant</th>
                            <th scope="col">Max. de participant</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($sports as $sports)
                                <tr data-id=" data-rank=">
                                    <td>{{$sports->name}}</td>
                                    <td>{{$sports->description}}</td>
                                    <td>{{$sports->min_participant}}</td>
                                    <td>{{$sports->max_participant}}</td>
                                    <td>
                                        <a href="{{ route('sports.edit', $sports) }}" class="btn-edit"><input type="button" class="btn btn-main grow" value="Edit"></a>
                                        <a href="{{ route('sports.destroy', $sports) }}" class="btn-delete"><input type="button" class="btn btn-main grow" value="Delete"></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
@endsection
