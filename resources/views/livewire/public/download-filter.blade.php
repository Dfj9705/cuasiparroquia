<div>
    <div class="mb-4">
        <select class="form-select" wire:model.live="category">
            <option value="">
                Todas las categorías
            </option>

            @foreach ($categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->dcat_name }}
                </option>
            @endforeach
        </select>
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
                <x-public.empty-state title="No se encontraron descargas" message="Intenta buscar con otros términos" />
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $downloads->links() }}
    </div>
</div>