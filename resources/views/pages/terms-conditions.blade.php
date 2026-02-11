@extends('layout.layout')

@section('title', 'Términos y Condiciones')

@section('content')

<div class="container my-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h1 class="mb-4">Términos y Condiciones de Uso</h1>

            <section class="mb-4">
                <h2 class="h4 mb-3">1. Términos Generales</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </section>

            <section class="mb-4">
                <h2 class="h4 mb-3">2. Uso de la Plataforma</h2>
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
            </section>

            <section class="mb-4">
                <h2 class="h4 mb-3">3. Limitación de Responsabilidad</h2>
                <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.</p>
            </section>

            <div class="alert alert-info mt-5">
                <strong>Última actualización:</strong> 10 de febrero de 2026
            </div>

            <a href="{{ route('index') }}" class="btn btn-primary mt-3">Volver al inicio</a>
        </div>
    </div>
</div>

@endsection
