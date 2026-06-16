<div>
    <div class="row mb-4">
        <div class="col-md-6">
            <input type="text" class="form-control" placeholder="Buscar noticia..."
                wire:model.live.debounce.500ms="search">
        </div>
    </div>

    <div wire:loading.class="opacity-50">
        <div class="row">
            @forelse ($posts as $post)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if ($post->post_image)
                            <img src="{{ asset('storage/' . $post->post_image) }}" class="card-img-top"
                                alt="{{ $post->post_title }}">
                        @endif

                        <div class="card-body">
                            <small class="text-muted">
                                {{ $post->postCategory?->pcat_name }}
                            </small>

                            <h5 class="card-title mt-2">
                                {{ $post->post_title }}
                            </h5>

                            <p class="card-text">
                                {{ $post->post_excerpt }}
                            </p>

                            <a href="{{ route('public.posts.show', $post->post_slug) }}" class="btn btn-primary">
                                Leer más
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        No se encontraron noticias.
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </div>
</div>