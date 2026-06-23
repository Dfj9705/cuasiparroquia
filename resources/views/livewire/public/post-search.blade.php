<div>
    <div class="mb-4">
        <input type="text" class="form-control" placeholder="Buscar noticias..."
            wire:model.live.debounce.500ms="search">
    </div>

    <div class="row g-4">
        @forelse ($posts as $post)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm">

                    @if ($post->post_image)
                        <img src="{{ asset('storage/' . $post->post_image) }}" class="card-img-top"
                            alt="{{ $post->post_title }}">
                    @endif

                    <div class="card-body">
                        <span class="badge bg-label-primary mb-2">
                            {{ $post->category?->cat_name ?? 'Noticia' }}
                        </span>

                        <h5 class="card-title">
                            {{ $post->post_title }}
                        </h5>

                        <p class="text-muted">
                            {{ Str::limit(strip_tags($post->post_content), 120) }}
                        </p>

                        <a href="{{ route('posts.show', $post) }}" class="btn btn-primary btn-sm">
                            Leer más
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <x-public.empty-state title="No se encontraron noticias" message="Intenta buscar con otros términos" />
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $posts->links() }}
    </div>
</div>