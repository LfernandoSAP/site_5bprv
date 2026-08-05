@extends('layouts.apple')

@section('title', 'Notícias & Informe | 5º BPRv')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Barlow+Condensed:wght@400;700;900&display=swap" rel="stylesheet">
<style>
    :root {
        --news-gold: #d5aa32;
        --news-black: #050505;
        --news-card: #111111;
        --news-border: rgba(213, 170, 50, 0.2);
    }

    html body {
        background-color: var(--news-black) !important;
        background: var(--news-black) !important;
        color: #ffffff;
    }

    /* ── Hero ── */
    .news-hero {
        height: 50vh;
        min-height: 400px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        overflow: hidden;
        background: radial-gradient(circle at center, rgba(213, 170, 50, 0.08), transparent 70%);
    }

    .hero-label {
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 6px;
        color: var(--news-gold);
        margin-bottom: 1.5rem;
        display: block;
        animation: fadeInDown 1s ease-out;
    }

    .hero-title {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: clamp(3rem, 8vw, 6rem);
        font-weight: 900;
        letter-spacing: -2px;
        line-height: 0.9;
        margin-bottom: 1rem;
        background: linear-gradient(to bottom, #ffffff 50%, #888888 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: fadeInUp 1s ease-out;
    }

    /* ── Destaques ── */
    .highlights-section {
        margin-top: -100px;
        position: relative;
        z-index: 10;
        padding-bottom: 5rem;
    }

    .destaque-card {
        background: var(--news-card);
        border: 1px solid var(--news-border);
        border-radius: 32px;
        padding: 3rem;
        height: 100%;
        position: relative;
        overflow: hidden;
        transition: all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
        box-shadow: 0 30px 60px rgba(0,0,0,0.5);
        text-decoration: none;
        color: inherit;
        display: block;
    }

    .destaque-card:hover {
        transform: translateY(-12px);
        border-color: var(--news-gold);
        box-shadow: 0 40px 80px rgba(213, 170, 50, 0.15);
        color: inherit;
        text-decoration: none;
    }

    .badge-gold {
        display: inline-block;
        padding: 6px 16px;
        background: linear-gradient(45deg, var(--news-gold), #fff7d1);
        color: #000;
        border-radius: 50px;
        font-weight: 900;
        font-size: 0.7rem;
        text-transform: uppercase;
        margin-bottom: 2rem;
    }

    .badge-silver {
        display: inline-block;
        padding: 6px 16px;
        background: linear-gradient(45deg, #888, #fff);
        color: #000;
        border-radius: 50px;
        font-weight: 900;
        font-size: 0.7rem;
        text-transform: uppercase;
        margin-bottom: 2rem;
    }

    .destaque-name {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 2.5rem;
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 1rem;
        color: #ffffff;
    }

    .destaque-meta {
        color: var(--news-gold);
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-size: 0.85rem;
        margin-bottom: 1.5rem;
        display: block;
    }

    .destaque-meta-white {
        color: #fff;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-size: 0.85rem;
        margin-bottom: 1.5rem;
        display: block;
    }

    .destaque-portrait {
        width: 100%;
        height: 260px;
        background: linear-gradient(135deg, #1a1a1a 0%, #333 100%);
        border-radius: 20px;
        margin-bottom: 2rem;
        overflow: hidden;
        border: 1px solid rgba(255,255,255,0.05);
        flex-shrink: 0;
    }

    /* ── Grid de Notícias ── */
    .events-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 2.5rem;
        padding-bottom: 4rem;
    }

    .event-card {
        background: #111;
        border-radius: 24px;
        overflow: hidden;
        border: 1px solid rgba(255,255,255,0.03);
        transition: all 0.4s ease;
        text-decoration: none;
        color: inherit;
        display: block;
    }

    .event-card:hover {
        background: #161616;
        border-color: rgba(213, 170, 50, 0.3);
        color: inherit;
        text-decoration: none;
        transform: translateY(-4px);
    }

    .event-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        opacity: 0.7;
        transition: opacity 0.4s;
        display: block;
    }

    .event-card:hover .event-image { opacity: 1; }

    .event-placeholder {
        width: 100%;
        height: 200px;
        background: linear-gradient(135deg, #1a1a1a, #222);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .event-content { padding: 2rem; }

    .event-date {
        font-size: 0.75rem;
        color: var(--news-gold);
        font-weight: bold;
        margin-bottom: 1rem;
        display: block;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .event-title {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
        line-height: 1.2;
        color: #ffffff;
    }

    .event-excerpt {
        color: #666;
        font-size: 0.92rem;
        line-height: 1.6;
        margin-bottom: 1.25rem;
    }

    .event-cta {
        color: var(--news-gold);
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* ── Animations ── */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-30px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* ── Footer dark ── */
    footer {
        background-color: #050505 !important;
        border-top: 1px solid rgba(255,255,255,0.05) !important;
        color: #555 !important;
    }
</style>
@endsection

@section('content')
<main>

    {{-- ── Hero ── --}}
    <section class="news-hero">
        <div class="px-4">
            <span class="hero-label">Notícias & Informe</span>
            <h1 class="hero-title">O DIA A DIA DO<br><span style="color: var(--news-gold); -webkit-text-fill-color: var(--news-gold);">5º BATALHÃO</span></h1>
            <p class="text-gray-500 font-serif italic text-lg max-w-2xl mx-auto mt-6">
                Eventos, conquistas e os destaques operacionais que mantêm o Sudoeste Paulista seguro.
            </p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4">

        {{-- ── Destaques (is_featured = true) ── --}}
        @if($featuredPosts->isNotEmpty())
        <section class="highlights-section">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                @foreach($featuredPosts as $featured)
                <a href="{{ rtrim(config('app.url'), '/') }}/publicacao.php?slug={{ urlencode($featured->slug) }}"
                   class="destaque-card"
                   style="{{ $loop->index === 1 ? 'border-color: rgba(255,255,255,0.1);' : '' }}">

                    @if($loop->index === 0)
                        <span class="badge-gold">Destaque</span>
                        <span class="destaque-meta">Publicação em Destaque</span>
                    @else
                        <span class="badge-silver">Destaque Operacional</span>
                        <span class="destaque-meta-white">Informe Especial</span>
                    @endif

                    <div style="display:flex; gap:2rem; align-items:center; flex-wrap:wrap;">
                        {{-- Portrait --}}
                        <div class="destaque-portrait" style="flex:0 0 240px; width:240px;">
                            @if($featured->image_path)
                                <img src="{{ \Illuminate\Support\Facades\Storage::url($featured->image_path) }}"
                                     style="width:100%; height:100%; object-fit:cover; display:block;" alt="{{ $featured->title }}">
                            @else
                                <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center;
                                            background: radial-gradient(circle at center, rgba(213,170,50,0.15), transparent);">
                                    <svg viewBox="0 0 640 512" style="width:38%; fill:var(--news-gold); opacity:0.25;">
                                        <path d="M480 80C480 35.82 515.8 0 560 0C604.2 0 640 35.82 640 80C640 124.2 604.2 160 560 160C515.8 160 480 124.2 480 80zM0 456.1C0 445.6 2.964 435.3 8.551 426.4L225.3 81.01C231.9 70.42 243.5 64 256 64C268.5 64 280.1 70.42 286.8 81.01L412.7 281.7L460.9 202.7C464.1 196.1 472.2 192 480 192C487.8 192 495 196.1 499.1 202.7L631.1 419.1C636.9 428.6 640 439.1 640 449.8V480C640 497.7 625.7 512 608 512H32C14.33 512 0 497.7 0 480V456.1z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        {{-- Texto --}}
                        <div style="flex:1; min-width:200px;">
                            <h3 class="destaque-name">{{ $featured->title }}</h3>
                            @if($featured->excerpt)
                                <p style="color:#888; font-style:italic; font-size:0.95rem; line-height:1.6; margin-bottom:1.5rem;">
                                    {{ Str::limit($featured->excerpt, 160) }}
                                </p>
                            @endif
                            <div style="width:3rem; height:3px; margin-bottom:1rem;
                                        background-color:{{ $loop->index === 0 ? '#d5aa32' : '#ffffff' }};"></div>
                            <span style="font-size:0.75rem; font-weight:700; text-transform:uppercase;
                                         letter-spacing:3px; color:#555;">
                                {{ $featured->published_at?->translatedFormat('F Y') ?? 'Publicação' }}
                            </span>
                        </div>
                    </div>

                </a>
                @endforeach

            </div>
        </section>
        @endif

        {{-- ── Mural de Notícias ── --}}
        <section class="py-12">
            <div class="flex items-center gap-4 mb-12">
                <h2 class="text-3xl font-heading font-bold">EVENTOS & INFORMES</h2>
                <div class="flex-grow h-[1px] bg-white/10"></div>
                @if($posts->total() > 0)
                    <span class="text-sm" style="color: #444;">{{ $posts->total() }} publicações</span>
                @endif
            </div>

            @if($posts->isNotEmpty())
            <div class="events-grid">
                @foreach($posts as $post)
                <a href="{{ rtrim(config('app.url'), '/') }}/publicacao.php?slug={{ urlencode($post->slug) }}" class="event-card">
                    @if($post->image_path)
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($post->image_path) }}"
                             class="event-image" alt="{{ $post->title }}">
                    @else
                        <div class="event-placeholder">
                            <img src="{{ asset('imagens/logos/logo_5rv.png') }}"
                                 style="height: 40px; opacity: 0.12;" alt="">
                        </div>
                    @endif
                    <div class="event-content">
                        <span class="event-date">
                            {{ $post->published_at?->translatedFormat('d M Y') ?? 'Publicação' }}
                        </span>
                        <h4 class="event-title">{{ $post->title }}</h4>
                        @if($post->excerpt)
                            <p class="event-excerpt">{{ Str::limit($post->excerpt, 120) }}</p>
                        @endif
                        <span class="event-cta">Ler publicação →</span>
                    </div>
                </a>
                @endforeach
            </div>

            @if($posts->hasPages())
                <div class="flex justify-center pb-12 mt-4">
                    {{ $posts->links() }}
                </div>
            @endif

            @else
            <div class="text-center py-24">
                <p style="color: #333; font-size: 1.1rem;">Nenhuma publicação disponível no momento.</p>
                <p style="color: #2a2a2a; font-size: 0.9rem; margin-top: 0.5rem;">Em breve, novidades do 5º BPRv.</p>
            </div>
            @endif

        </section>

    </div>
</main>
@endsection
