@props(['event'])

<div class="col-xl-4 pb-5">
    <div class="card">
        <a href="{{ route('events.show', $event->id) }}" title="Voir l'événement">
            <div>
                @if ($event->img != null)
                    <img class="card-img" src="images/joutes/{{ $event->img }}" alt="Image de l'événement">
                @else
                    <!-- Get uploaded image -->
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $event->name }}</h5>
                    @if (Auth::check() && Auth::user()->role->slug == 'ADMIN')
                        <a href="{{ route('events.show', $event) }}" title="Éditer l'événement"
                            class="btn btn-outline-primary">Éditer l'événement</a>
                    @endif

                    {{ $slot }}

                </div>
            </div>
        </a>
    </div>
</div>
