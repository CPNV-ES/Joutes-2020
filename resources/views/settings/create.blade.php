@extends('layout')

@section('content')
    <div class="view-container">
        <form action="{{ route('settings.store') }}" method="POST"
              class="py-4 flex flex-col space-y-8 items-center">
            @csrf
            <table>
                <thead>
                <th class="text-left">
                    Paramètre
                </th>
                <th class="text-left">
                    Valeur
                </th>
                    <th class="text-left">
                        <a href="{{route('settings.index')}}">Back</a>
                    </th>
                </thead>
                <tbody>

                <tr>
                    <td>
                        <input type="text" name="name" id="name"
                               class="bg-gray-50 rounded text-gray-700" placeholder="Nom"/>
                    </td>
                    <td>
                        <input type="text" name="value" id="name"
                               class="bg-gray-50 rounded text-gray-700" placeholder="Valeur" />
                    </td>
                </tr>
                </tbody>
            </table>
            <button type="submit"
                    class="btn btn-main">
                Sauvegarder
            </button>
        </form>
    </div>
@endsection
