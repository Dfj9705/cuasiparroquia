<div>
    <div class="row mb-4 g-3">
        <div class="col-md-6">
            <input type="text" class="form-control" placeholder="Buscar descarga..."
                wire:model.live.debounce.500ms="search">
        </div>

        <div class="col-md-4">
            <select class="form-select" wire:model.live="category">
                <option value="">Todas las categorías</option>

                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->dcat_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <button type="button" class="btn btn-outline-secondary w-100"
                wire:click="$set('search', ''); $set('category', '')">
                Limpiar
            </button>
        </div>
    </div>

    <div wire:loading.class="opacity-50">
        <div class="row">
            @forelse ($downloads as $download)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column">
                            <small class="text-muted">
                                {{ $download->downloadCategory?->dcat_name }}
                            </small>

                            <h5 class="card-title mt-2">
                                {{ $download->down_title }}
                            </h5>

                            <p class="card-text">
                                {{ $download->down_description }}
                            </p>

                            <div class="mt-auto">
                                @if ($download->down_file_type || $download->down_file_size)
                                    <small class="text-muted d-block mb-2">
                                        {{ $download->down_file_type }}

                                        @if ($download->down_file_size)
                                            · {{ number_format($download->down_file_size / 1024, 2) }} KB
                                        @endif
                                    </small>
                                @endif

                                <a href="{{ asset('storage/' . $download->down_file) }}" target="_blank"
                                    class="btn btn-primary">
                                    Descargar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        No se encontraron descargas.
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $downloads->links() }}
        </div>
    </div>
</div>