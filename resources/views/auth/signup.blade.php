@extends('layout.layout')

@section('title', 'Iniciar Sesión')

@section('content')
    <div class="login-container">
        <h2>Registro de usuarios</h2>
        <form action="{{ route('signup') }}" method="post">
            @csrf
            <label for="username">Nombre de usuario</label>
            <input type="text" name="username" id="username" value="{{ old('username') }}" class="@error('username') is-invalid @enderror">
            @error('username')
                <small class="error">{{ $message }}</small>
            @enderror

            <label for="name">Nombre completo</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="@error('name') is-invalid @enderror">
            @error('name')
                <small class="error">{{ $message }}</small>
            @enderror

            <label for="email">Email</label>
            <input type="text" name="email" id="email" value="{{ old('email') }}" class="@error('email') is-invalid @enderror">
            @error('email')
                <small class="error">{{ $message }}</small>
            @enderror

            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" class="@error('password') is-invalid @enderror">
            @error('password')
                <small class="error">{{ $message }}</small>
            @enderror

            <label for="password_confirmation"> Repite la contraseña</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="@error('password_confirmation') is-invalid @enderror">
            @error('password_confirmation')
                <small class="error">{{ $message }}</small>
            @enderror

            <input type="submit" value="Enviar">

        </form>

    </div>
@endsection
