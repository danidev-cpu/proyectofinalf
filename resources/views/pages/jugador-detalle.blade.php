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
        <p><strong>Dorsal:</strong> {{ $player->number }}</p>

        <a href="{{ route('jugadores.index') }}" style="display: inline-block; margin-top: 20px;">Volver a Jugadores</a>
    </div>

@endsection
