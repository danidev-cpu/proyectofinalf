@extends('layout.layout')

@section('title', 'Iniciar Sesión')

@section('content')

<div class="login-container">
    <form action="{{ route('login') }}" method="post">
        @csrf
        <label for="username">Nombre de usuario</label><br>
        <input type="text" name="username" id="username" value="{{ old('username') }}"><br>

        <label for="password">Contraseña</label><br>
        <input type="password" name="password" id="password">

        <input type="submit" value="Iniciar Sesión">
</div>

@endsection
