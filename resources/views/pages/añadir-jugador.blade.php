@extends('layout.layout')

@section('title', 'Añadir jugadores')

@section('content')
    <div class="login-container">
        <form action="{{ route('jugadores.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label>Nombre:</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name')
                <small class="error">{{ $message }}</small>
            @enderror

            <label>Número:</label>
            <input type="number" name="number" value="{{ old('number') }}" min="1" max="99" required>
            @error('number')
                <small class="error">{{ $message }}</small>
            @enderror

            <label>Posición:</label>
            <input type="text" name="position" value="{{ old('position') }}">

            <label>País:</label>
            <input type="text" name="country" value="{{ old('country') }}">

            <label>Twitter:</label>
            <input type="text" name="twitter" value="{{ old('twitter') }}">

            <label>Instagram:</label>
            <input type="text" name="instagram" value="{{ old('instagram') }}">

            <label>Twitch:</label>
            <input type="text" name="twitch" value="{{ old('twitch') }}">

            <label>Foto del Jugador:</label>
            <input type="file" name="photo" accept="image/*">
            @error('photo')
                <small class="error">{{ $message }}</small>
            @enderror

            <label>
                <input type="checkbox" name="visible" value="1" {{ old('visible') ? 'checked' : '' }}>
                Visible
            </label>

            <button type="submit">Guardar</button>
        </form>
    </div>

@endsection
