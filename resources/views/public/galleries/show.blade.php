@extends('layouts.apple')

@section('title', $gallery->title.' | 5º BPRv')

@section('styles')
<style>
    :root {
        --gold: #d5aa32;
        --black: #050505;
        --card: #111111;
    }

    html body {
        background-color: var(--black) !important;
        background: var(--black) !important;
        color: #ffffff;
    }

    .gallery-hero {
        width: 100%;
        height: 45vh;
        min-height: 300px;
        object-fit: cover;
        display: block;
    }

    .gallery-hero-placeholder {
        width: 100%;
        height: 35vh;
        min-height: 240px;
        background: linear-gradient(180deg, #111 0%, var(--black) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .photo-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.25rem;
    }

    .photo-item {
        border-radius: 16px;
        overflow: hidden;
        background: var(--card);
        border: 1px solid rgba(255,255,255,0.04);
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .photo-item:hover {
        transform: translateY(-4px);
        border-color: rgba(213,170,50,0.3);
        box-shadow: 0 15px 30px rgba(0,0,0,0.5);
    }

    .photo-item img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        display: block;
        opacity: 0.8;
        transition: opacity 0.3s;
    }

    .photo-item:hover img { opacity: 1; }

    .photo-caption {
        padding: 1rem 1.25rem;
    }

    .photo-caption h5 {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 1rem;
        font-weight: 700;
        color: #fff;
        margin: 0 0 4px;
    }

    .photo-caption p {
        font-size: 0.8rem;
        color: #555;
        margin: 0;
    }

    /* Lightbox */
    #lightbox {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 9999;
        background: rgba(0,0,0,0.96);
        backdrop-filter: blur(12px);
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }

    #lightbox.active { display: flex; }

    #lightbox img {
        max-width: 92%;
        max-height: 85vh;
        border-radius: 10px;
        box-shadow: 0 0 60px rgba(0,0,0,0.8);
        border: 1px solid rgba(255,255,255,0.08);
    }

    #lightbox-caption {
        margin-top: 1rem;
        color: rgba(255,255,255,0.5);
        font-size: 0.85rem;
        text-align: center;
    }

    .lightbox-close {
        position: absolute;
        top: 1.5rem;
        right: 2rem;
        font-size: 2.5rem;
        font-weight: 200;
        color: var(--gold);
        cursor: pointer;
        line-height: 1;
        transition: transform 0.2s;
    }

    .lightbox-close:hover { transform: scale(1.2) rotate(90deg); }

    .lightbox-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        color: #fff;
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 1.4rem;
        transition: background 0.2s;
    }

    .lightbox-nav:hover { background: var(--gold); color: #000; }
    .lightbox-prev { left: 1.5rem; }
    .lightbox-next { right: 1.5rem; }

    footer {
        background-color: var(--black) !important;
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

    {{-- Hero image --}}
    @if($gallery->cover_image_path)
        <img src="{{ \Illuminate\Support\Facades\Storage::url($gallery->cover_image_path) }}"
             class="gallery-hero" alt="{{ $gallery->title }}">
    @else
        <div class="gallery-hero-placeholder">
            <img src="{{ asset('imagens/logos/logo_5rv.png') }}"
                 style="height: 60px; opacity: 0.07;" alt="">
        </div>
    @endif

    <div class="max-w-7xl mx-auto px-4 py-12 animate-in">

        {{-- Back --}}
        <a href="{{ route('public.galleries.index') }}"
           style="color: var(--gold); font-size: 0.75rem; text-transform: uppercase;
                  letter-spacing: 2px; font-weight: 700; text-decoration: none;
                  display: inline-flex; align-items: center; gap: 6px; margin-bottom: 3rem;">
            ← Voltar às Galerias
        </a>

        {{-- Header --}}
        <header style="margin-bottom: 3rem;">
            <p style="font-size: 0.72rem; text-transform: uppercase; letter-spacing: 3px;
                      color: var(--gold); font-weight: 700; margin-bottom: 0.75rem;">
                Galeria Institucional
                @if($gallery->photos_count > 0)
                    &nbsp;·&nbsp; {{ $gallery->photos_count }} {{ $gallery->photos_count == 1 ? 'imagem' : 'imagens' }}
                @endif
            </p>
            <h1 style="font-family: 'Barlow Condensed', sans-serif;
                       font-size: clamp(2.5rem, 6vw, 4.5rem);
                       font-weight: 900; line-height: 0.95; letter-spacing: -2px;
                       color: #fff; margin: 0 0 1.25rem;">
                {{ $gallery->title }}
            </h1>
            @if($gallery->description)
                <p style="font-size: 1.1rem; color: #666; line-height: 1.7; max-width: 700px; margin: 0;">
                    {{ $gallery->description }}
                </p>
            @endif
            <div style="height: 1px; background: linear-gradient(to right, var(--gold), transparent); margin-top: 2rem;"></div>
        </header>

        {{-- Photo grid --}}
        @if($gallery->photos->isNotEmpty())
        <div class="photo-grid" id="photoGrid">
            @foreach($gallery->photos as $photo)
            <div class="photo-item" data-index="{{ $loop->index }}"
                 data-src="{{ \Illuminate\Support\Facades\Storage::url($photo->file_path) }}"
                 data-caption="{{ $photo->title ?: '' }}">
                <img src="{{ \Illuminate\Support\Facades\Storage::url($photo->file_path) }}"
                     alt="{{ $photo->title ?: 'Foto institucional' }}">
                @if($photo->title || $photo->caption)
                <div class="photo-caption">
                    @if($photo->title)<h5>{{ $photo->title }}</h5>@endif
                    @if($photo->caption)<p>{{ $photo->caption }}</p>@endif
                </div>
                @endif
            </div>
            @endforeach
        </div>

        @else
        <div class="text-center py-20">
            <p style="color: #333; font-size: 1rem;">Esta galeria ainda não possui fotos publicadas.</p>
        </div>
        @endif

    </div>

    {{-- Lightbox --}}
    <div id="lightbox">
        <span class="lightbox-close" id="lightboxClose">&times;</span>
        <button class="lightbox-nav lightbox-prev" id="lightboxPrev">&#8249;</button>
        <img id="lightboxImg" src="" alt="">
        <div id="lightbox-caption"></div>
        <button class="lightbox-nav lightbox-next" id="lightboxNext">&#8250;</button>
    </div>

</main>
@endsection

@section('scripts')
<script>
(function () {
    const photos = Array.from(document.querySelectorAll('.photo-item'));
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightboxImg');
    const lightboxCaption = document.getElementById('lightbox-caption');
    let current = 0;

    function open(index) {
        current = index;
        const item = photos[current];
        lightboxImg.src = item.dataset.src;
        lightboxCaption.textContent = item.dataset.caption || '';
        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function close() {
        lightbox.classList.remove('active');
        document.body.style.overflow = '';
    }

    function prev() { open((current - 1 + photos.length) % photos.length); }
    function next() { open((current + 1) % photos.length); }

    photos.forEach((item, i) => item.addEventListener('click', () => open(i)));

    document.getElementById('lightboxClose').addEventListener('click', close);
    document.getElementById('lightboxPrev').addEventListener('click', prev);
    document.getElementById('lightboxNext').addEventListener('click', next);

    lightbox.addEventListener('click', e => { if (e.target === lightbox) close(); });

    document.addEventListener('keydown', e => {
        if (!lightbox.classList.contains('active')) return;
        if (e.key === 'Escape') close();
        if (e.key === 'ArrowLeft') prev();
        if (e.key === 'ArrowRight') next();
    });
})();
</script>
@endsection
