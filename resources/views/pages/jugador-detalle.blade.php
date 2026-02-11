@extends('layout.layout')

@section('title', 'Detalle del Jugador')

@section('content')

    <div class="player-detail" style="max-width: 800px; margin: 0 auto; padding: 20px;">
        @if ($player->photo)
            <img src="{{ asset('storage/' . $player->photo) }}" style="width: 100%; max-width: 400px; height: auto;">
        @else
            <img src="{{ asset('images/default-player.png') }}" style="width: 100%; max-width: 400px;">
        @endif

        <h1>{{ $player->name }}</h1>
        <p><span class="text-strong">Dorsal:</span> {{ $player->number }}</p>
        <p><span class="text-strong">Posicion:</span> {{ $player->position ?: 'No disponible' }}</p>
        <p><span class="text-strong">Pais:</span> {{ $player->country ?: 'No disponible' }}</p>
        <p><span class="text-strong">Twitter:</span>
            @if ($player->twitter)
                <a href="{{ $player->twitter }}" target="_blank" rel="noopener">{{ $player->twitter }}</a>
            @else
                No disponible
            @endif
        </p>
        <p><span class="text-strong">Instagram:</span>
            @if ($player->instagram)
                <a href="{{ $player->instagram }}" target="_blank" rel="noopener">{{ $player->instagram }}</a>
            @else
                No disponible
            @endif
        </p>
        <p><span class="text-strong">Twitch:</span>
            @if ($player->twitch)
                <a href="{{ $player->twitch }}" target="_blank" rel="noopener">{{ $player->twitch }}</a>
            @else
                No disponible
            @endif
        </p>

        <a href="{{ route('jugadores.index') }}" style="display: inline-block; margin-top: 20px;">Volver a Jugadores</a>
    </div>

@endsection
