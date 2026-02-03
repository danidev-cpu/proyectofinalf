@extends('layout.layout')

@section('title', 'Dónde estamos')

@section('content')
    <h2>Sede de Team Heretics</h2>
    <div class="where-to-find-us">
        <h2>Ubicación de la sede</h2>
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3036.909982796725!2d-3.7399680846085366!3d40.40039537936614!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd4227efc4d43c27%3A0x8107f8c3b8d9f7db!2sCalle%20Ulises%2C%20108%2C%2028043%20Madrid%2C%20España!5e0!3m2!1ses!2sus!4v1699198800000!5m2!1ses!2sus"
            width="100%" height="300" style="border:0;" loading="lazy"></iframe>
    </div>

@endsection
