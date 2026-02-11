@extends('layout.layout')

@section('title', 'Mensajes de Contacto')

@section('content')

<div class="container my-5">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <h1 class="mb-4">Mensajes de Contacto</h1>

            @if ($messages->isEmpty())
                <div class="alert alert-info">
                    No hay mensajes de contacto.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Nombre</th>
                                <th>Asunto</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($messages as $message)
                                <tr class="{{ $message->readed ? '' : 'table-warning' }}">
                                    <td>{{ $message->name }}</td>
                                    <td>
                                        <a href="{{ route('mensaje.show', $message) }}" class="text-decoration-none">
                                            {{ $message->subject }}
                                        </a>
                                    </td>
                                    <td>{{ $message->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center">
                    {{ $messages->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
