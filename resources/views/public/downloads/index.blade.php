@extends('layouts.public')

@section('title', 'Descargas')

@section('content')

    <section class="py-5">
        <div class="container">
            <div class="mb-4">
                <span class="badge bg-label-primary mb-2">Recursos</span>
                <h1 class="h2 mb-0">Descargas disponibles</h1>
            </div>

            <div class="row g-4">
                @forelse ($downloads as $download)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <span class="badge bg-label-primary mb-3">
                                    {{ $download->category?->down_cat_name ?? 'Archivo' }}
                                </span>

                                <h5 class="card-title">
                                    {{ $download->down_title }}
                                </h5>

                                <p class="text-muted">
                                    {{ Str::limit(strip_tags($download->down_description), 120) }}
                                </p>

                                <a href="{{ asset('storage/' . $download->down_file) }}" class="btn btn-primary btn-sm"
                                    target="_blank">
                                    Descargar
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center py-5">
                                <h5>No hay descargas disponibles</h5>
                                <p class="text-muted mb-0">Pronto encontrarás recursos publicados.</p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $downloads->links() }}
            </div>
        </div>
    </section>

@endsection