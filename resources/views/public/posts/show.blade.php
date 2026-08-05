@extends('layouts.apple')

@section('title', $post->title.' | 5º BPRv')

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

    .post-hero {
        width: 100%;
        height: 60vh;
        min-height: 400px;
        object-fit: cover;
        display: block;
    }

    .post-hero--compact {
        width: min(calc(100% - 2rem), 414px);
        height: auto;
        min-height: 0;
        max-height: none;
        object-fit: contain;
        margin: 2rem auto 0;
        border-radius: 16px;
    }

    .post-hero--portrait {
        width: min(calc(100% - 2rem), 460px);
    }

    .post-detail--compact {
        padding-top: 2rem !important;
    }

    .post-detail--compact .post-meta-label {
        color: #9a6d00;
    }

    .post-detail--compact .post-title {
        max-width: 980px;
        margin: 0.75rem 0 1rem;
        color: #171717;
        font-size: clamp(1.9rem, 3.5vw, 3.25rem);
        line-height: 1.08;
        letter-spacing: -0.5px;
    }

    .post-detail--compact header > div:last-child {
        margin-bottom: 1.25rem !important;
    }

    .post-detail--compact .post-excerpt {
        margin-bottom: 1.5rem;
        color: #3f3f46;
        font-weight: 500;
        line-height: 1.6;
    }

    .post-detail--compact .post-body {
        color: #3f3f46;
        font-weight: 400;
    }

    .post-hero-placeholder {
        width: 100%;
        height: 40vh;
        min-height: 280px;
        background: linear-gradient(180deg, #111 0%, #050505 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .post-meta-label {
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 3px;
        color: var(--news-gold);
        font-weight: 700;
    }

    .post-title {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: clamp(2.5rem, 6vw, 5rem);
        font-weight: 900;
        line-height: 0.95;
        letter-spacing: -2px;
        color: #ffffff;
        margin: 1.25rem 0 1.75rem;
    }

    .post-excerpt {
        font-size: 1.15rem;
        color: #777;
        line-height: 1.75;
        border-left: 3px solid var(--news-gold);
        padding-left: 1.5rem;
        margin-bottom: 2.5rem;
        font-style: italic;
    }

    .post-body {
        font-family: 'Source Sans 3', sans-serif;
        font-size: 1.08rem;
        line-height: 1.85;
        color: #bbb;
        white-space: pre-line;
    }

    .author-avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: var(--news-gold);
        color: #000;
        font-weight: 900;
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .related-card {
        background: #111;
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 18px;
        padding: 1.5rem;
        transition: all 0.3s ease;
        text-decoration: none;
        color: inherit;
        display: block;
    }

    .related-card:hover {
        border-color: rgba(213, 170, 50, 0.3);
        background: #161616;
        color: inherit;
        text-decoration: none;
        transform: translateY(-3px);
    }

    footer {
        background-color: #050505 !important;
        border-top: 1px solid rgba(255,255,255,0.05) !important;
        color: #555 !important;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .animate-in { animation: fadeInUp 0.7s ease-out; }
</style>
@endsection

@section('content')
<main>

    {{-- ── Imagem hero ── --}}
    @if($post->image_path)
        <img src="{{ \Illuminate\Support\Facades\Storage::url($post->image_path) }}"
             class="post-hero {{ in_array($post->slug, ['ocorrencia-destaque-julho-2026', 'pm-do-mes-julho-2026'], true) ? 'post-hero--compact' : '' }} {{ $post->slug === 'pm-do-mes-julho-2026' ? 'post-hero--portrait' : '' }}"
             alt="{{ $post->title }}">
    @else
        <div class="post-hero-placeholder">
            <img src="{{ asset('imagens/logos/logo_5rv.png') }}"
                 style="height: 70px; opacity: 0.08;" alt="">
        </div>
    @endif

    <div class="max-w-4xl mx-auto px-4 py-14 animate-in {{ in_array($post->slug, ['ocorrencia-destaque-julho-2026', 'pm-do-mes-julho-2026'], true) ? 'post-detail--compact' : '' }}">

        {{-- ── Voltar ── --}}
        <a href="{{ route('public.noticias') }}"
           style="color: var(--news-gold); font-size: 0.75rem; text-transform: uppercase;
                  letter-spacing: 2px; font-weight: 700; text-decoration: none;
                  display: inline-flex; align-items: center; gap: 6px; margin-bottom: 3rem;">
            ← Voltar às Notícias
        </a>

        {{-- ── Cabeçalho ── --}}
        <header>
            <p class="post-meta-label">
                Publicação Oficial
                @if($post->published_at)
                    &nbsp;·&nbsp; {{ $post->published_at->translatedFormat('d \d\e F \d\e Y') }}
                @endif
            </p>

            <h1 class="post-title">{{ $post->title }}</h1>

            @if($post->author)
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 2rem;">
                <div class="author-avatar">{{ strtoupper(substr($post->author->name, 0, 1)) }}</div>
                <div>
                    <div style="font-weight: 700; color: #fff; font-size: 0.9rem;">{{ $post->author->name }}</div>
                    <div style="font-size: 0.72rem; color: #555; text-transform: uppercase; letter-spacing: 1px;">Comunicação Social</div>
                </div>
            </div>
            @endif

            <div style="height: 1px; background: linear-gradient(to right, var(--news-gold), transparent); margin-bottom: 3rem;"></div>
        </header>

        {{-- ── Conteúdo ── --}}
        @if($post->excerpt)
            <p class="post-excerpt">{{ $post->excerpt }}</p>
        @endif

        <div class="post-body">{{ $post->content }}</div>

        <div style="height: 1px; background: rgba(255,255,255,0.05); margin: 4rem 0 3rem;"></div>

        {{-- ── Publicações relacionadas ── --}}
        @if($relatedPosts->isNotEmpty())
        <section>
            <h3 style="font-family: 'Barlow Condensed', sans-serif; font-size: 1rem;
                       font-weight: 900; letter-spacing: 4px; text-transform: uppercase;
                       color: #444; margin-bottom: 1.5rem;">
                Outras Publicações
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($relatedPosts as $related)
                <a href="{{ route('public.posts.show', $related) }}" class="related-card">
                    <div style="font-size: 0.68rem; color: var(--news-gold); font-weight: 700;
                                text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">
                        {{ $related->published_at?->translatedFormat('d M Y') ?? '' }}
                    </div>
                    <h4 style="font-family: 'Barlow Condensed', sans-serif; font-size: 1.05rem;
                               font-weight: 700; color: #fff; line-height: 1.2; margin: 0;">
                        {{ $related->title }}
                    </h4>
                </a>
                @endforeach
            </div>
        </section>
        @endif

    </div>
</main>
@endsection
