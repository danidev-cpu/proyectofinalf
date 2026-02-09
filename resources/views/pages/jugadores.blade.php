@extends('layout.layout')

@section('title', 'teamheretics')

@section('content')

    <div class="players-grid" style="display: flex; gap: 20px; flex-wrap: wrap;">
        @foreach ($players as $player)
            <div class="player-card" style="border: 1px solid #ddd; padding: 10px; width: 200px;">
                @if ($player->image)
                    <img src="{{ asset('storage/' . $player->image) }}" style="width: 100%; height: auto;">
                @else
                    <img src="{{ asset('images/default-player.png') }}" style="width: 100%;">
                @endif

                <h3>{{ $player->name }}</h3>
                <p>Dorsal: {{ $player->number }}</p>

                <a href="{{ route('players.show', $player) }}">Ver Ficha Técnica</a>

                @if (auth()->user()?->role === 'admin')
                    <hr>
                    <a href="{{ route('players.edit', $player) }}">Modificar</a>
                @endif
            </div>
        @endforeach
    </div>

@endsection
