@extends('layout.layout')

@section('title', 'Contacto')

@section('content')

<div class="container my-5">
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <h1 class="mb-4">Contactanos</h1>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('contact.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input 
                        type="text" 
                        class="form-control @error('name') is-invalid @enderror" 
                        id="name" 
                        name="name" 
                        value="{{ Auth::check() ? Auth::user()->name : old('name') }}"
                        @auth readonly @endauth
                    >
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="subject" class="form-label">Asunto</label>
                    <input 
                        type="text" 
                        class="form-control @error('subject') is-invalid @enderror" 
                        id="subject" 
                        name="subject" 
                        value="{{ old('subject') }}"
                    >
                    @error('subject')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="text" class="form-label">Mensaje</label>
                    <textarea 
                        class="form-control @error('text') is-invalid @enderror" 
                        id="text" 
                        name="text" 
                        rows="6"
                        placeholder="Dejanos un mensaje..."
                    >{{ old('text') }}</textarea>
                    @error('text')
                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-dark">Enviar Mensaje</button>
            </form>
        </div>
    </div>
</div>

@endsection

