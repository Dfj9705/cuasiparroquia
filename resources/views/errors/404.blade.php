@extends('layouts.public')

@section('title', 'Página no encontrada')

@section('content')
    <section class="py-5">
        <div class="container text-center py-5">

            <h1 class="display-1 fw-bold text-primary">
                404
            </h1>

            <h2>Página no encontrada</h2>

            <p class="text-muted">
                La página que buscas no existe o fue movida.
            </p>

            <a href="{{ route('home') }}" class="btn btn-primary">
                Volver al inicio
            </a>

        </div>
    </section>
@endsection