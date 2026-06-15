@extends('layouts.public')

@section('title', 'Descargas')
@section('meta_description', 'Documentos y archivos disponibles para descarga.')

@section('content')

    <section class="py-5 bg-light">
        <div class="container">
            <h1 class="fw-bold mb-2">Descargas</h1>
            <p class="text-muted mb-0">Documentos y archivos disponibles.</p>
        </div>
    </section>

    <section class="py-5">
        <div class="container">

            <div class="row g-4">
                @forelse($downloads as $download)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">

                                @if($download->category)
                                    <span class="badge bg-label-primary mb-2">
                                        {{ $download->category->dcat_name }}
                                    </span>
                                @endif

                                <h5 class="card-title">
                                    {{ $download->down_title }}
                                </h5>

                                <p class="text-muted">
                                    {{ $download->down_description }}
                                </p>

                                <div class="small text-muted mb-3">
                                    @if($download->down_file_type)
                                        <div>Tipo: {{ $download->down_file_type }}</div>
                                    @endif

                                    @if($download->down_file_size)
                                        <div>
                                            Tamaño:
                                            {{ number_format($download->down_file_size / 1024, 2) }} KB
                                        </div>
                                    @endif

                                    @if($download->down_published_at)
                                        <div>
                                            Publicado:
                                            {{ $download->down_published_at->format('d/m/Y') }}
                                        </div>
                                    @endif
                                </div>

                                @if($download->down_file)
                                    <a href="{{ Storage::url($download->down_file) }}" target="_blank"
                                        class="btn btn-primary btn-sm">
                                        Descargar
                                    </a>
                                @endif

                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">
                            No hay descargas publicadas.
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $downloads->withQueryString()->links() }}
            </div>

        </div>
    </section>

@endsection