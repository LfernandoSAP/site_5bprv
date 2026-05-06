@extends('layouts.apple')

@section('title', 'Publicações | 5º BPRv')

@section('styles')
<style>
    :root {
        --news-gold: #d5aa32;
        --news-black: #050505;
    }

    html body {
        background-color: var(--news-black) !important;
        background: var(--news-black) !important;
        color: #ffffff;
    }

    .page-hero {
        padding: 5rem 1rem 8rem;
        text-align: center;
        background: radial-gradient(circle at center, rgba(213,170,50,0.06), transparent 70%);
    }

    .page-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 6px;
        color: var(--news-gold);
        margin-bottom: 1rem;
        display: block;
    }

    .page-title {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: clamp(3rem, 8vw, 5rem);
        font-weight: 900;
        letter-spacing: -2px;
        line-height: 0.9;
        background: linear-gradient(to bottom, #ffffff 50%, #888 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .posts-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 2rem;
        padding-bottom: 6rem;
    }

    .post-card {
        background: #111;
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid rgba(255,255,255,0.04);
        transition: all 0.35s ease;
        text-decoration: none;
        color: inherit;
        display: block;
    }

    .post-card:hover {
        background: #161616;
        border-color: rgba(213,170,50,0.25);
        color: inherit;
        text-decoration: none;
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.4);
    }

    .post-card-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        opacity: 0.72;
        transition: opacity 0.35s;
        display: block;
    }

    .post-card:hover .post-card-image { opacity: 1; }

    .post-card-placeholder {
        width: 100%;
        height: 200px;
        background: linear-gradient(135deg, #1a1a1a, #222);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .post-card-body { padding: 1.75rem; }

    .post-card-date {
        font-size: 0.7rem;
        color: var(--news-gold);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 0.75rem;
        display: block;
    }

    .post-card-title {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 1.3rem;
        font-weight: 700;
        line-height: 1.2;
        color: #fff;
        margin-bottom: 0.75rem;
    }

    .post-card-excerpt {
        color: #5a5a5a;
        font-size: 0.9rem;
        line-height: 1.6;
        margin-bottom: 1.25rem;
    }

    .post-card-cta {
        color: var(--news-gold);
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    footer {
        background-color: #050505 !important;
        border-top: 1px solid rgba(255,255,255,0.05) !important;
        color: #555 !important;
    }
</style>
@endsection

@section('content')
<main>

    <div class="page-hero">
        <span class="page-label">Portal 5º BPRv</span>
        <h1 class="page-title">PUBLICAÇÕES</h1>
        <p style="color: #444; font-style: italic; margin-top: 1rem; font-size: 1rem;">
            Comunicados e atualizações oficiais do Batalhão.
        </p>
    </div>

    <div class="max-w-7xl mx-auto px-4">

        <div class="flex items-center gap-4 mb-10" style="margin-top: -3rem;">
            <h2 style="font-family: 'Barlow Condensed', sans-serif; font-size: 1.1rem;
                       font-weight: 900; letter-spacing: 3px; text-transform: uppercase;
                       color: #fff; margin: 0; white-space: nowrap;">
                TODAS AS PUBLICAÇÕES
            </h2>
            <div class="flex-grow" style="height: 1px; background: rgba(255,255,255,0.07);"></div>
            @if($posts->total() > 0)
                <span style="font-size: 0.75rem; color: #444; white-space: nowrap;">
                    {{ $posts->total() }} registros
                </span>
            @endif
        </div>

        @if($posts->isNotEmpty())
        <div class="posts-grid">
            @foreach($posts as $post)
            <a href="{{ route('public.posts.show', $post) }}" class="post-card">
                @if($post->image_path)
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($post->image_path) }}"
                         class="post-card-image" alt="{{ $post->title }}">
                @else
                    <div class="post-card-placeholder">
                        <img src="{{ asset('imagens/logos/logo_5rv.png') }}"
                             style="height: 38px; opacity: 0.1;" alt="">
                    </div>
                @endif
                <div class="post-card-body">
                    <span class="post-card-date">
                        {{ $post->published_at ? $post->published_at->translatedFormat('d M Y') : 'Publicação' }}
                    </span>
                    <h3 class="post-card-title">{{ $post->title }}</h3>
                    @if($post->excerpt)
                        <p class="post-card-excerpt">{{ Str::limit($post->excerpt, 110) }}</p>
                    @endif
                    <span class="post-card-cta">Ler publicação →</span>
                </div>
            </a>
            @endforeach
        </div>

        @if($posts->hasPages())
            <div class="flex justify-center pb-16">
                {{ $posts->links() }}
            </div>
        @endif

        @else
        <div class="text-center py-24">
            <p style="color: #333; font-size: 1.1rem;">Nenhuma publicação disponível no momento.</p>
        </div>
        @endif

    </div>
</main>
@endsection
