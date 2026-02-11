@extends('layout.layout')

@section('title', 'Iniciar Sesión')

@section('content')
    <h1>Bienvenido, {{ $user->name }}</h1>
    <p>Tu email es: {{ $user->email }}</p>

    {{-- Sección protegida visualmente --}}
    @auth
        @if ($user instanceof \App\Models\User && $user->isAdmin())
            <div class="alert alert-warning">
                Eres administrador.
            </div>
        @endif
        <div class="alert alert-success">
            Estás viendo contenido exclusivo para usuarios registrados.
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Cerrar Sesión</button>
        </form>
    @endauth
@endsection
