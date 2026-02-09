@extends('layout.layout')

@section('title', 'Añadir Eventos')

@section('content')
    <div class="login-container">
        <form action="{{ route('events.store') }}" method="post">
            <label for="nombre-evento">Nombre del evento:</label> <br>
            <input type="text" id="nombre-evento" name="nombre-evento"> <br>
            <label for="foto ">Foto del evento:</label><br>
            <input type="file"><br>
            <button type="submit">Guardar evento</button>
        </form>
    </div>
@endsection
