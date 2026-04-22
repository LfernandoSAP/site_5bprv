@extends('layouts.apple')

@section('title', $post->title.' | 5º BPRv')

@section('content')
    <section class="container py-5 my-5">
        <div class="mb-5 reveal active">
            <a href="{{ route('public.posts.index') }}" class="btn btn-outline-dark rounded-pill px-4 fw-semibold shadow-sm">
                ← Voltar às Notícias
            </a>
        </div>

        <article class="reveal active">
            <header class="mb-5">
                <div class="small text-uppercase fw-bold mb-3" style="color: #86868b; letter-spacing: 1.5px;">
                    Publicação Oficial &bull; {{ optional($post->published_at)->format('d/m/Y') }}
                </div>
                <h1 class="display-3 fw-bold mb-4" style="letter-spacing: -2px; line-height: 1.1;">{{ $post->title }}</h1>
                
                @if ($post->author)
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                            <span class="fw-bold small">{{ substr($post->author->name, 0, 1) }}</span>
                        </div>
                        <div>
                            <div class="fw-bold">{{ $post->author->name }}</div>
                            <div class="small text-muted">Comunicação Social</div>
                        </div>
                    </div>
                @endif
            </header>

            @if ($post->image_path)
                <div class="rounded-5 overflow-hidden mb-5 shadow-lg" style="height: 60vh; min-height: 400px;">
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($post->image_path) }}" 
                         class="w-100 h-100 object-fit-cover" alt="{{ $post->title }}">
                </div>
            @endif

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="fs-4 fw-light text-muted mb-5 border-start ps-4" style="line-height: 1.6; border-width: 4px !important; border-color: #0066cc !important;">
                        {{ $post->excerpt }}
                    </div>
                    
                    <div class="article-body fs-5" style="line-height: 1.8; color: #1d1d1f; white-space: pre-line;">
                        {{ $post->content }}
                    </div>
                </div>
            </div>
        </article>

        @if ($relatedPosts->isNotEmpty())
            <div class="mt-5 pt-5 reveal active">
                <hr class="mb-5 opacity-10">
                <h3 class="display-6 fw-bold mb-4" style="letter-spacing: -1px;">Outras Publicações</h3>
                <div class="row g-4">
                    @foreach ($relatedPosts as $relatedPost)
                        <div class="col-lg-4">
                            <article class="card bento-card shadow-sm h-100 border-0">
                                <a href="{{ route('public.posts.show', $relatedPost) }}" class="text-decoration-none text-dark h-100 d-flex flex-column">
                                    <div class="card-body p-4">
                                        <div class="small text-muted mb-2">{{ optional($relatedPost->published_at)->format('d/m/Y') }}</div>
                                        <h4 class="card-title fw-bold fs-5 mb-0" style="letter-spacing: -0.5px;">{{ $relatedPost->title }}</h4>
                                    </div>
                                </a>
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </section>
@endsection
