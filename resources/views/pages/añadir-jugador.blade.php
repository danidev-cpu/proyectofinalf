@extends('layout.layout')

@section('title', 'Añadir jugadores')

@section('content')
    @csrf
    <div class="login-container">
        <form action="{{ route('players.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label>Nombre:</label>
            <input type="text" name="name" value="{{ old('name') }}">

            <label>Foto del Jugador:</label>
            <input type="file" name="image" accept="image/*">
            @error('image')
                <small style="color:red">{{ $message }}</small>
            @enderror

            <button type="submit">Guardar</button>
        </form>
    </div>

@endsection
