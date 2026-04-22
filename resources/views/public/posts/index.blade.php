@extends('layouts.apple')

@section('title', 'Publicações do 5º BPRv')

@section('content')
    <section class="container py-5 my-5">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-3 mb-5 reveal active">
            <div>
                <h1 class="display-4 fw-bold mb-0" style="letter-spacing: -1.5px;">Notícias</h1>
                <p class="fs-5 text-muted mt-2">Comunicados e atualizações oficiais do nosso batalhão.</p>
            </div>
            <a href="{{ route('public.home') }}" class="btn btn-dark rounded-pill px-4 py-2 fw-semibold shadow-sm">
                Voltar à Home
            </a>
        </div>

        <div class="row g-4">
            @forelse ($posts as $post)
                <div class="col-lg-4 reveal active">
                    <article class="card bento-card shadow-sm h-100 border-0">
                        <a href="{{ route('public.posts.show', $post) }}" class="text-decoration-none text-dark h-100 d-flex flex-column">
                            @if ($post->image_path)
                                <div class="bento-img-container" style="height: 240px;">
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($post->image_path) }}" 
                                         class="w-100 h-100 object-fit-cover" alt="{{ $post->title }}">
                                </div>
                            @else
                                <div class="bento-img-container bg-dark d-flex align-items-center justify-content-center" style="height: 240px;">
                                    <img src="{{ asset('imagens/logos/logo_5rv.png') }}" class="w-50 opacity-25" alt="5º BPRv">
                                </div>
                            @endif
                            <div class="card-body p-4 d-flex flex-column">
                                <div class="small text-uppercase fw-bold mb-2" style="color: #86868b; letter-spacing: 1px;">
                                    {{ optional($post->published_at)->format('d \d\e F, Y') ?? 'Publicação' }}
                                </div>
                                <h2 class="card-title fw-bold fs-4 mb-3" style="letter-spacing: -0.5px;">{{ $post->title }}</h2>
                                <p class="card-text text-muted mb-4">{{ Str::limit($post->excerpt, 120) }}</p>
                                <div class="mt-auto">
                                    <span class="fw-semibold" style="color: #0066cc;">Ler mais →</span>
                                </div>
                            </div>
                        </a>
                    </article>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="display-6 text-muted">Nenhuma publicação disponível no momento.</div>
                </div>
            @endforelse
        </div>

        @if ($posts->hasPages())
            <div class="pt-5 mt-5 d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        @endif
    </section>
@endsection
