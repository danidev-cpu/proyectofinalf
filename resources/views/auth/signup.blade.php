@extends('layout.layout')

@section('title', 'Iniciar Sesión')

@section('content')
    <div class="login-container">
        <h2>Registro de usuarios</h2>
        <form action="{{ route('signup') }}" method="post">
            @csrf
            <label for="username">Nombre de usuario</label>
            <input type="text" name="username" id="username" value="{{ old('username') }}">

            <label for="name">Nombre completo</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}">

            <label for="email">Email</label>
            <input type="text" name="email" id="email" value="{{ old('email') }}">

            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password">

            <label for="password_confirmation"> Repite la contraseña</label>
            <input type="password" name="password_confirmation" id="password_confirmation">

            <input type="submit" value="Enviar">

        </form>

        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

    </div>
@endsection
