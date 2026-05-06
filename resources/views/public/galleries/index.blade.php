@extends('layouts.apple')

@section('title', 'Galerias | 5º BPRv')

@section('styles')
<style>
    :root {
        --gold: #d5aa32;
        --black: #050505;
        --card: #111111;
        --border: rgba(213, 170, 50, 0.15);
    }

    html body {
        background-color: var(--black) !important;
        background: var(--black) !important;
        color: #ffffff;
    }

    .gallery-hero {
        padding: 5rem 1rem 7rem;
        text-align: center;
        background: radial-gradient(circle at center, rgba(213,170,50,0.07), transparent 70%);
    }

    .page-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 6px;
        color: var(--gold);
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

    .galleries-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 2rem;
        padding-bottom: 6rem;
    }

    .gallery-card {
        background: var(--card);
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid var(--border);
        transition: all 0.35s ease;
        text-decoration: none;
        color: inherit;
        display: block;
    }

    .gallery-card:hover {
        background: #161616;
        border-color: rgba(213,170,50,0.35);
        color: inherit;
        text-decoration: none;
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.5);
    }

    .gallery-card-image {
        width: 100%;
        height: 220px;
        object-fit: cover;
        opacity: 0.75;
        transition: opacity 0.35s;
        display: block;
    }

    .gallery-card:hover .gallery-card-image { opacity: 1; }

    .gallery-card-placeholder {
        width: 100%;
        height: 220px;
        background: linear-gradient(135deg, #1a1a1a, #222);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .gallery-card-body { padding: 1.75rem; }

    .gallery-card-count {
        font-size: 0.7rem;
        color: var(--gold);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 0.6rem;
        display: block;
    }

    .gallery-card-title {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 1.4rem;
        font-weight: 700;
        line-height: 1.2;
        color: #fff;
        margin-bottom: 0.6rem;
    }

    .gallery-card-desc {
        color: #555;
        font-size: 0.88rem;
        line-height: 1.6;
        margin-bottom: 1.25rem;
    }

    .gallery-card-cta {
        color: var(--gold);
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    footer {
        background-color: var(--black) !important;
        border-top: 1px solid rgba(255,255,255,0.05) !important;
        color: #555 !important;
    }
</style>
@endsection

@section('content')
<main>

    <div class="gallery-hero">
        <span class="page-label">Portal 5º BPRv</span>
        <h1 class="page-title">GALERIAS</h1>
        <p style="color: #444; font-style: italic; margin-top: 1rem; font-size: 1rem;">
            Registros visuais das operações e solenidades do batalhão.
        </p>
    </div>

    <div class="max-w-7xl mx-auto px-4">

        <div class="flex items-center gap-4 mb-10" style="margin-top: -3rem;">
            <h2 style="font-family: 'Barlow Condensed', sans-serif; font-size: 1.1rem;
                       font-weight: 900; letter-spacing: 3px; text-transform: uppercase;
                       color: #fff; margin: 0; white-space: nowrap;">
                ÁLBUNS INSTITUCIONAIS
            </h2>
            <div class="flex-grow" style="height: 1px; background: rgba(255,255,255,0.07);"></div>
            @if($galleries->total() > 0)
                <span style="font-size: 0.75rem; color: #444; white-space: nowrap;">
                    {{ $galleries->total() }} {{ $galleries->total() == 1 ? 'álbum' : 'álbuns' }}
                </span>
            @endif
        </div>

        @if($galleries->isNotEmpty())
        <div class="galleries-grid">
            @foreach($galleries as $gallery)
            <a href="{{ route('public.galleries.show', $gallery) }}" class="gallery-card">
                @if($gallery->cover_image_path)
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($gallery->cover_image_path) }}"
                         class="gallery-card-image" alt="{{ $gallery->title }}">
                @else
                    <div class="gallery-card-placeholder">
                        <img src="{{ asset('imagens/logos/logo_5rv.png') }}"
                             style="height: 38px; opacity: 0.1;" alt="">
                    </div>
                @endif
                <div class="gallery-card-body">
                    <span class="gallery-card-count">
                        {{ $gallery->photos_count }} {{ $gallery->photos_count == 1 ? 'foto' : 'fotos' }}
                    </span>
                    <h3 class="gallery-card-title">{{ $gallery->title }}</h3>
                    @if($gallery->description)
                        <p class="gallery-card-desc">{{ Str::limit($gallery->description, 100) }}</p>
                    @endif
                    <span class="gallery-card-cta">Ver galeria →</span>
                </div>
            </a>
            @endforeach
        </div>

        @if($galleries->hasPages())
            <div class="flex justify-center pb-16">
                {{ $galleries->links() }}
            </div>
        @endif

        @else
        <div class="text-center py-24">
            <p style="color: #333; font-size: 1.1rem;">Nenhuma galeria disponível no momento.</p>
        </div>
        @endif

    </div>
</main>
@endsection
