@extends('layout.layout')

@section('title', 'teamheretics')

@section('content')

    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="mb-0">Jugadores</h1>
            @auth
                @if(auth()->user()->isAdmin())
                    <a class="btn btn-outline-dark" href="{{ route('jugadores.create') }}">Añadir jugador</a>
                @endif
            @endauth
        </div>
    </div>

    <div class="container">
        <div class="players-grid" style="display: flex; gap: 20px; flex-wrap: wrap;">
            @foreach ($players as $player)
                <div class="player-card" style="border: 1px solid #ddd; padding: 10px; width: 200px;">
                @if ($player->photo)
                    <img src="{{ asset('storage/' . $player->photo) }}" style="width: 100%; height: auto;">
                @else
                    <img src="{{ asset('images/default-player.png') }}" style="width: 100%;">
                @endif

                <h3>{{ $player->name }}</h3>
                <p>Dorsal: {{ $player->number }}</p>

                @auth
                    <a href="{{ route('jugadores.show', $player) }}">Ver Ficha Técnica</a>

                    @if (auth()->user()->isAdmin())
                        <hr>
                        <form method="POST" action="{{ route('jugadores.toggleVisibility', $player) }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-secondary">
                                {{ $player->visible ? 'Hacer Invisible' : 'Hacer Visible' }}
                            </button>
                        </form>
                    @endif
                @endauth
                </div>
            @endforeach
        </div>
    </div>

@endsection
