@extends('layout.layout')

@section('title', $event->name)

@section('content')
    <div class="container my-5">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h1 class="h3">{{ $event->name }}</h1>
                        <p class="text-muted mb-2">
                            @if($event->date)
                                {{ $event->date->format('d/m/Y') }} {{ $event->hour }}
                            @else
                                Fecha por confirmar - {{ $event->hour }}
                            @endif
                        </p>
                        <p class="mb-2">{{ $event->location }}</p>
                        <span class="badge text-bg-secondary mb-3">{{ ucfirst($event->type) }}</span>
                        <p>{{ $event->description }}</p>
                        <p class="small text-muted">Tags: {{ $event->tags }}</p>

                        <div class="d-flex gap-2">
                            <form method="POST" action="{{ route('events.like', $event) }}">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger">
                                    {{ $liked ? 'Quitar me gusta' : 'Me gusta' }}
                                </button>
                            </form>
                            <a href="{{ route('events') }}" class="btn btn-outline-secondary">Volver</a>
                        </div>
                    </div>
                </div>

                @if($event->map)
                    <div class="card shadow-sm mt-4">
                        <div class="card-body">
                            <h2 class="h5">Mapa</h2>
                            <div class="ratio ratio-16x9">
                                <iframe src="{{ $event->map }}" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="h5">Jugadores participantes</h2>
                        @if($eventPlayersForView->isEmpty())
                            <p class="text-muted">Aun no hay jugadores asignados.</p>
                        @else
                            <ul class="list-group list-group-flush mb-3">
                                @foreach($eventPlayersForView as $player)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>{{ $player->name }} (#{{ $player->number }})</span>
                                        @if(auth()->user()->isAdmin())
                                            <form method="POST" action="{{ route('events.players.detach', [$event, $player]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-dark">Quitar</button>
                                            </form>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        @if(auth()->user()->isAdmin())
                            <h3 class="h6">Anadir jugador visible</h3>
                            <form method="POST" action="{{ route('events.players.attach', $event) }}" class="d-flex gap-2">
                                @csrf
                                <select name="player_id" class="form-select" required>
                                    <option value="">Selecciona jugador</option>
                                    @foreach($visiblePlayers as $player)
                                        @if(!$event->players->contains($player->id))
                                            <option value="{{ $player->id }}">{{ $player->name }} (#{{ $player->number }})</option>
                                        @endif
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-outline-primary">Anadir</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
