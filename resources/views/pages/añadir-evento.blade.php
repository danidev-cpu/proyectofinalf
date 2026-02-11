@extends('layout.layout')

@section('title', $event->exists ? 'Editar Evento' : 'Añadir Evento')

@section('content')
    <div class="container my-5" style="max-width: 720px;">
        <h1 class="mb-4">{{ $event->exists ? 'Editar evento' : 'Añadir evento' }}</h1>

        <form action="{{ $event->exists ? route('events.update', $event) : route('events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($event->exists)
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="name" class="form-label">Nombre del evento</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $event->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">Fecha</label>
                <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date', $event->date ? $event->date->format('Y-m-d') : '') }}">
                @error('date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="hour" class="form-label">Hora</label>
                <input type="time" name="hour" id="hour" class="form-control @error('hour') is-invalid @enderror" value="{{ old('hour', $event->hour) }}" required>
                @error('hour')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Lugar</label>
                <textarea name="location" id="location" class="form-control @error('location') is-invalid @enderror" rows="2" required>{{ old('location', $event->location) }}</textarea>
                @error('location')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="map" class="form-label">URL del mapa (Google Maps embed)</label>
                <input type="text" name="map" id="map" class="form-control @error('map') is-invalid @enderror" value="{{ old('map', $event->map) }}">
                @error('map')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descripcion</label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="5" required>{{ old('description', $event->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Tipo</label>
                <select name="type" id="type" class="form-select @error('type') is-invalid @enderror" required>
                    @foreach(['official' => 'Official', 'exhibition' => 'Exhibition', 'charity' => 'Charity'] as $value => $label)
                        <option value="{{ $value }}" @selected(old('type', $event->type) === $value)>{{ $label }}</option>
                    @endforeach
                </select>
                @error('type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tags" class="form-label">Tags</label>
                <input type="text" name="tags" id="tags" class="form-control @error('tags') is-invalid @enderror" value="{{ old('tags', $event->tags) }}" required>
                @error('tags')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="visible" id="visible" value="1" @checked(old('visible', $event->visible))>
                <label class="form-check-label" for="visible">Visible</label>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-dark">Guardar</button>
                <a href="{{ route('events') }}" class="btn btn-outline-secondary">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
