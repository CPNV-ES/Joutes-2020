@extends('layout')

@section('content')
    <div class="view-container">
        <form action="{{ route('settings.update') }}" method="POST"
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
                @if(env('APP_DEBUG'))
                    <th class="text-left">
                        <a href="{{route('settings.create')}}">New Params</a>
                    </th>
                @endif
                </thead>
                <tbody>
                @foreach ($settings as $key => $value)
                    <tr>
                        <td>
                            {!! \Str::of(e(__('settings.' . $key)))->explode("\n")->map(fn ($line, $index) => $index == 0 ? $line : '<span class="text-gray-500">' . $line . "</span>" )->join("<br>") !!}
                        </td>
                        <td>
                            <input type="text" name="{{ $key }}" id="{{ $key }}"
                                   class="bg-gray-50 rounded text-gray-700"
                                   value="{{ $value }}" />
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <button type="submit"
                    class="btn btn-main">
                Sauver les paramètres
            </button>
        </form>
    </div>
@endsection
