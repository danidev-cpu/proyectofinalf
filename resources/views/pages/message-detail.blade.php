@extends('layout.layout')

@section('title', 'Detalle del Mensaje')

@section('content')
    <div class="container my-5" style="max-width: 800px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h4 mb-0">{{ $message->subject }}</h1>
            <a href="{{ route('mensaje') }}" class="btn btn-outline-secondary btn-sm">Volver</a>
        </div>

        <div class="panel shadow-sm">
            <div class="panel-body">
                <p class="text-muted mb-2">De: {{ $message->name }}</p>
                <p class="text-muted mb-4">Fecha: {{ $message->created_at->format('d/m/Y H:i') }}</p>
                <p style="white-space: pre-line;">{{ $message->text }}</p>

                <form method="POST" action="{{ route('mensaje.destroy', $message) }}" onsubmit="return confirm('Eliminar mensaje?');" class="mt-4">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar mensaje</button>
                </form>
            </div>
        </div>
    </div>
@endsection
