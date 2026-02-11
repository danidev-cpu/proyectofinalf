@extends('layout.layout')

@section('title', $event->name)

@section('content')
    @php
        $user = auth()->user();
    @endphp
    <div class="container my-5">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row g-4">
            <div class="col-lg-7">
                <div class="panel shadow-sm">
                    <div class="panel-body">
                        <h1 class="h3">{{ $event->name }}</h1>
                        <p class="text-muted mb-2">
                            @if ($event->date)
                                {{ $event->date->format('d/m/Y') }} {{ $event->hour }}
                            @else
                                Fecha por confirmar - {{ $event->hour }}
                            @endif
                        </p>
                        <p class="mb-2">{{ $event->location }}</p>
                        <span class="badge text-bg-secondary mb-3">{{ ucfirst($event->type) }}</span>
                        <p>{{ $event->description }}</p>
                        <p class="small text-muted">Tags: {{ $event->tags }}</p>

                        <div class="d-flex flex-wrap gap-2 align-items-center">
                            <a href="{{ route('events') }}" class="btn btn-outline-secondary">Volver</a>
                            <form method="POST" action="{{ route('events.like', $event) }}">
                                @csrf
                                <button type="submit" class="btn btn-danger ">
                                    {{ $isLiked ? 'Quitar me gusta' : 'Me gusta' }}
                                </button>
                            </form>
                            <span class="text-muted small">{{ $likesCount }} me gusta</span>
                        </div>
                    </div>
                </div>
            </div>
            @if ($event->map)
                <div class="col-lg-5">
                    <div class="panel shadow-sm">
                        <div class="panel-body">
                            <h2 class="h5">Mapa</h2>
                            <div class="ratio ratio-16x9">
                                <iframe src="{{ $event->map }}" style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
