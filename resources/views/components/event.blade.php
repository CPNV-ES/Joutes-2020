@props(['event'])

<div class="col-xl-4 pb-5">
    <a href="{{ route('events.show', $event->id) }}" title="Voir l'événement">
        <div class="card" style="width: 18rem;">

            @if ($event->img != null)
                <img class="card-img" src="images/joutes/{{ $event->img }}" alt="Image de l'événement">
            @else
                <!-- Get uploaded image -->
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $event->name }}</h5>
                @if (Gate::allows('isAdmin'))
                    <a href="{{ route('events.show', $event) }}" title="Éditer l'événement"
                        class="btn btn-outline-primary">Éditer l'événement</a>
                @endif
                @if (Gate::allows('isOrg'))
                    <a href="{{ route('students.show', $event->id) }}" class="btn btn-main" title="">

                        Participation : {{ $event->percentageParticipation() }}
                        <i class="fa fa-solid fa-percentage fa-1x" aria-hidden="true"></i>
                    </a>
                @endif

                {{ $slot }}
            </div>
        </div>
    </a>
</div>
