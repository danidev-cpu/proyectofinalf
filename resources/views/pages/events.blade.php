@extends('layout.layout')

@section('title', 'Eventos')

@section('content')
    @php
        $user = auth()->user();
    @endphp
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Proximos eventos</h1>
            @auth
                @if ($user instanceof \App\Models\User && $user->isAdmin())
                    <a class="btn btn-outline-dark" href="{{ route('events.create') }}">Anadir evento</a>
                @endif
            @endauth
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row g-4">
            @forelse ($events as $event)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title mb-0">{{ $event->name }}</h5>
                                <span class="badge text-bg-secondary">{{ ucfirst($event->type) }}</span>
                            </div>
                            <p class="card-text text-muted mb-2">
                                @if ($event->date)
                                    {{ $event->date->format('d/m/Y') }} {{ $event->hour }}
                                @else
                                    Fecha por confirmar - {{ $event->hour }}
                                @endif
                            </p>
                            <p class="card-text mb-2">{{ $event->location }}</p>
                            <p class="card-text">{{ \Illuminate\Support\Str::limit($event->description, 120) }}</p>
                            <p class="small text-muted">Tags: {{ $event->tags }}</p>

                            <div class="mt-auto d-flex gap-2 flex-wrap">
                                @auth
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('events.show', $event) }}">Ver
                                        ficha</a>

                                    @if ($user instanceof \App\Models\User && $user->isAdmin())
                                        <a class="btn btn-sm btn-outline-secondary"
                                            href="{{ route('events.edit', $event) }}">Editar</a>
                                        <form method="POST" action="{{ route('events.destroy', $event) }}"
                                            onsubmit="return confirm('Eliminar evento?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-dark">Eliminar</button>
                                        </form>
                                    @endif
                                @else
                                    <span class="text-muted">Inicia sesion para ver detalles.</span>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">No hay eventos proximos.</div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
