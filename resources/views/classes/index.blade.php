@extends('layout')

@section('content')
    <div class="container">

        <div class="row">

            <div class="col-11 ml-n2">
                <h1 class="tournamentName">
                    Sainte-Croix
                </h1>
                <hr>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('classes.store',$classes) }}" method="post"
                      title="Synchroniser le liste des classes"
                      onsubmit="return confirm('Vous êtes sûr de vouloir synchroniser la liste des classes. ?');">
                    @csrf
                <table id="" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Classes</th>
                        <th scope="col">Year</th>
                        <th scope="col">Titulaire</th>
                        <th scope="col">Délégué</th>
                        <th scope="col">Status</th>
                        <th>

                                <button class="btn btn-main growIcon btnSynchroniser ">
                                    Synchroniser
                                </button>

                        </th>

                    </tr>
                    </thead>
                    <tbody>
                    @forelse($classes as $class)
                        <tr class="{{!$class['status']?'table-danger':($class['status']==='synchronisé'?'table-success':'table-secondary')}}">
                            <td>{{$class['name']}}</td>
                            <td>{{$class['year']}}</td>
                            <td>{{$class['holder']}}</td>
                            <td>{{$class['delegate']}}</td>
                            <td id="{{$class['name']}}">{{$class['status']?$class['status']:'inexistant'}}</td>
                            <td><input class="col-lg-12 synchroniser" name="{{$class['name']}}"
                                       type="checkbox" {{$class['status']==='synchronisé'? 'checked':''}}></td>
                        </tr>
                    @empty
                        <tr>
                            <td>Aucune classes pour l'instant ...</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                </form>
            </div>

        </div>

    </div>

   {{-- <script>
        let status = []
        const statusSynchroniser = document.querySelectorAll('.synchroniser')
        statusSynchroniser.forEach(checkbox => {
            checkbox.addEventListener('click', function () {
                if (checkbox.checked) {
                    checkbox.name

                    {{$name = 'checkbox.name'}}
                    {{session()->push('classes.name',$name)}}

                    //alert(status)
                }else {
                    status = status.filter(e => e !== checkbox.name)
                    alert(status)
                }
            })

        })
    </script>--}}

@stop


