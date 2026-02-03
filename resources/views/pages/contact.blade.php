@extends('layout.layout')

@section('title', 'teamheretics')

@section('content')
    <div class="screen-contact">
        <form action="contacto">
            <label>Contactanos</label><br>
            <input class="input-contact" type="text" placeholder="Dejanos un mensaje...">
        </form>
    </div>
@endsection
