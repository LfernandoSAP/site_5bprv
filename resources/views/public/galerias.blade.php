@extends('layouts.apple')

@section('title', 'Galeria de Eternos Comandantes | 5º BPRv')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Great+Vibes&family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
<style>
    /* ── Variáveis de Identidade ── */
    :root {
        --galeria-gold: #d5aa32;
        --galeria-black: #111111;
        --galeria-dark: #1a1a1a;
        --galeria-text: #ffffff;
        --font-serif: 'Playfair Display', serif;
        --font-charming: 'Great Vibes', cursive;
        --font-elegant: 'Cormorant Garamond', serif;
    }

    html body {
        background-color: var(--galeria-black) !important;
        background: var(--galeria-black) !important;
        color: var(--galeria-text);
    }

    .font-serif-playfair { font-family: var(--font-serif) !important; }
    .font-charming { font-family: var(--font-charming) !important; }
    .font-elegant { font-family: var(--font-elegant) !important; }

    /* ── Hero Especial ── */
    .galeria-hero {
        position: relative;
        height: 40vh;
        min-height: 320px;
        background-color: var(--galeria-black);
        background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.85)), url('{{ asset("imagens/viaturas.jpg") }}');
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
    }

    .shimmer-text {
        font-size: clamp(2.5rem, 5vw, 4.5rem);
        font-weight: 900;
        text-transform: none !important;
        background: linear-gradient(to right, #ffffff 20%, #d5aa32 40%, #ffffff 50%, #d5aa32 60%, #ffffff 80%);
        background-size: 200% auto;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: pmespWipe 8s linear infinite;
        filter: drop-shadow(0 4px 12px rgba(0,0,0,0.5));
    }

    @keyframes pmespWipe {
        0% { background-position: 150% center; }
        100% { background-position: -150% center; }
    }

    /* ── Molduras dos Comandantes ── */
    .portrait-frame {
        background: #1a1a1a;
        border-radius: 4px;
        padding: 12px 12px 16px;
        border: 1px solid rgba(213, 170, 50, 0.25);
        box-shadow: 0 8px 32px rgba(0,0,0,0.6), inset 0 0 0 1px rgba(255,255,255,0.04);
        transition: all 0.4s ease;
        text-align: center;
        position: relative;
    }

    .portrait-frame:hover {
        transform: translateY(-6px);
        border-color: rgba(213, 170, 50, 0.7);
        box-shadow: 0 20px 50px rgba(213, 170, 50, 0.12);
    }

    .portrait-frame.comandante-atual {
        border-color: #d5aa32;
        border-width: 2px;
        box-shadow: 0 0 0 1px #d5aa32, 0 20px 50px rgba(213, 170, 50, 0.2);
    }

    .portrait-frame.comandante-atual::before {
        content: "Comandante Interino";
        position: absolute;
        top: -12px;
        left: 50%;
        transform: translateX(-50%);
        background: #d5aa32;
        color: #111;
        font-size: 0.6rem;
        font-weight: 800;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        padding: 3px 10px;
        border-radius: 50px;
        white-space: nowrap;
        z-index: 10;
    }

    .portrait-placeholder {
        width: 100%;
        aspect-ratio: 3/4;
        background: linear-gradient(160deg, #222 0%, #111 100%);
        border-radius: 2px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 0.75rem;
        overflow: hidden;
        position: relative;
        padding: 12%; 
    }

    .portrait-placeholder::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, #d5aa32, transparent);
        z-index: 1;
    }

    .commander-name {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 0.9rem;
        font-weight: 700;
        color: #ffffff;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        line-height: 1.2;
        margin-top: 0.4rem;
    }

    .commander-rank {
        font-size: 0.65rem;
        color: #d5aa32;
        font-weight: 600;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        margin-top: 2px;
    }

    .commander-period {
        font-size: 0.6rem;
        color: rgba(255,255,255,0.4);
        font-weight: 500;
        letter-spacing: 0.02em;
        margin-top: 1px;
    }

    /* ── Efeitos Challenge Coin ── */
    .coin-container {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 2.5rem;
        margin-bottom: 1.5rem;
        perspective: 1000px;
    }

    .coin-img {
        width: 160px;
        height: auto;
        filter: drop-shadow(0 15px 30px rgba(0,0,0,0.6));
        animation: coinFloat 4s ease-in-out infinite;
    }

    .coin-img:nth-child(2) { animation-delay: -2s; }

    @keyframes coinFloat {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-15px) rotate(3deg); }
    }

    .shimmer-gold {
        background: linear-gradient(to right, #d5aa32 20%, #fff7d1 40%, #d5aa32 60%, #fff7d1 80%, #d5aa32 100%);
        background-size: 200% auto;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: shine 4s linear infinite;
    }

    @keyframes shine {
        to { background-position: 200% center; }
    }

    /* Fallback Grid */
    .grid { display: grid; }
    .gap-6 { gap: 1.5rem; }
    .grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    @media (min-width: 768px) {
        .md\:grid-cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
    }
    @media (min-width: 1024px) {
        .lg\:grid-cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)); }
        .lg\:gap-8 { gap: 2rem; }
    }
</style>
@endsection

@section('content')
<div style="background-color: var(--galeria-black);">
    
    <section class="galeria-hero">
        <div class="px-4">
            <h1 class="shimmer-text font-heading mb-4">Galeria de Eternos Comandantes</h1>
            <p class="font-light tracking-[0.3em] uppercase opacity-80 text-sm md:text-base">
                Preservando o Legado dos Guardiões do Sudoeste
            </p>
        </div>
    </section>

    <section class="py-24">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-serif-playfair font-bold text-white mb-4">Eternos Comandantes</h2>
                <div class="w-20 h-1 bg-[#d5aa32] mx-auto mb-6"></div>
                <p class="font-serif-playfair italic text-lg text-gray-500 max-w-2xl mx-auto">
                    "Lideranças que moldaram a história do 5º BPRv com honra, disciplina e dedicação ao policiamento rodoviário."
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 lg:gap-8">
              @php
              $comandantes = [
                ['rank' => 'Comandante Interino',  'periodo' => '02/04/2026 à Atual',        'nome' => 'Maj PM Eric Tadeu dos Santos',            'slug' => null,             'ajuste' => 'transform: scale(0.37);'],
                ['rank' => 'Eterno Comandante',   'periodo' => '29/05/2024 à 01/04/2026',    'nome' => 'Ten Cel PM Julio Teodoro Martins Junior', 'slug' => 'Julio.jpeg',     'ajuste' => 'transform: scale(0.5);'],
                ['rank' => 'Eterno Comandante',   'periodo' => '27/02/2023 à 28/05/2024',    'nome' => 'Ten Cel PM Marcel Ribeiro de Lima',       'slug' => 'marcel.jpeg',    'ajuste' => 'transform: scale(0.27);'],
                ['rank' => 'Eterno Comandante',   'periodo' => '25/08/2020 à 07/02/2023',    'nome' => 'Ten Cel PM Hugo Araujo Santos',           'slug' => 'hugo.jpeg',      'ajuste' => 'transform: scale(0.3);'],
                ['rank' => 'Eterno Comandante',   'periodo' => '14/02/2019 à 24/08/2020',    'nome' => 'Ten Cel PM Menemilton Soares de Souza Júnior', 'slug' => 'menemilton.jpeg', 'ajuste' => 'transform: scale(0.42);'],
                ['rank' => 'Eterno Comandante',   'periodo' => '12/04/2017 à 13/02/2019',    'nome' => 'Ten Cel PM Dalton Augusto Infanti',       'slug' => 'infanti.jpeg',   'ajuste' => 'transform: scale(0.35);'],
                ['rank' => 'Eterno Comandante',   'periodo' => '07/06/2016 à 11/04/2017',    'nome' => 'Ten Cel PM Marco Antônio de Carvalho',    'slug' => 'marco-antonio-de-carvalho-1038x1230.jpg', 'ajuste' => 'transform: scale(0.37);'],
                ['rank' => 'Eterno Comandante',   'periodo' => '12/06/2014 à 06/06/2016',    'nome' => 'Ten Cel PM Magno Julião dos Santos',      'slug' => 'magno-juliao-dos-santos-1038x692.jpg', 'ajuste' => 'transform: scale(0.7);'],
                ['rank' => 'Eterno Comandante',   'periodo' => '16/12/2013 à 25/01/2014',    'nome' => 'Ten Cel PM Newton Hugolino Michelazzo',   'slug' => 'newton-hugolino-michelazzo.jpg', 'ajuste' => 'transform: scale(0.7);'],
                ['rank' => 'Eterno Comandante',   'periodo' => '16/06/2012 à 15/12/2013',    'nome' => 'Ten Cel PM José Luiz Frank',              'slug' => 'jose-luiz-frank.jpg', 'ajuste' => 'transform: scale(0.7);'],
                ['rank' => 'Eterno Comandante',   'periodo' => '04/01/2012 à 15/05/2012',    'nome' => 'Ten Cel PM José Carlos Marcondes de Souza', 'slug' => 'jose-carlos-marcondes-de-souza.jpg', 'ajuste' => 'transform: scale(0.7);'],
                ['rank' => 'Eterno Comandante',   'periodo' => '02/07/2011 à 03/01/2012',    'nome' => 'Ten Cel PM Augusto Francisco Cação',      'slug' => 'augusto-francisco-cacao.jpg', 'ajuste' => 'transform: scale(0.7);'],
                ['rank' => 'Eterno Comandante',   'periodo' => '11/02/2011 à 12/06/2011',    'nome' => 'Ten Cel PM Ramiro de Oliveira Domingos',  'slug' => 'ramiro-de-oliveira-domingos.jpg', 'ajuste' => 'transform: scale(0.7);'],
                ['rank' => 'Eterno Comandante',   'periodo' => '24/12/2008 à 10/02/2011',    'nome' => 'Ten Cel PM Wagner Quarterone',            'slug' => 'wagner-quarterone.jpg', 'ajuste' => 'transform: scale(0.7);'],
              ];
              @endphp

              @foreach($comandantes as $cmd)
                @php
                  $imagePath   = 'imagens/comandantes/' . $cmd['slug'];
                  $imagemExiste = $cmd['slug'] &&
                                  (file_exists(public_path($imagePath)) || file_exists(base_path($imagePath)));
                @endphp

                <div class="portrait-frame {{ $loop->first ? 'comandante-atual' : '' }}">
                  <div class="portrait-placeholder">
                    @if($imagemExiste)
                      <img src="{{ asset($imagePath) }}"
                           alt="{{ $cmd['nome'] }}"
                           style="{{ $cmd['ajuste'] }}"
                           class="max-w-full max-h-full object-contain mx-auto"
                           loading="lazy">
                    @else
                      <svg viewBox="0 0 448 512" style="width:38%;opacity:0.12;fill:#d5aa32;">
                        <path d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128
                                 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288
                                 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"/>
                      </svg>
                    @endif
                  </div>
                  <p class="commander-rank">{{ $cmd['rank'] }}</p>
                  <p class="commander-period">{{ $cmd['periodo'] }}</p>
                  <h4 class="commander-name">{{ $cmd['nome'] }}</h4>
                </div>
              @endforeach
            </div>
        </div>
    </section>

    <section class="py-24" style="background-color: #0d0d0d;">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-16 text-center">
                <div class="lg:col-span-1">
                    <div class="coin-container">
                        <img src="{{ asset('imagens/logos/logo_cois1.png') }}" alt="Coin Frente" class="coin-img">
                        <img src="{{ asset('imagens/logos/logo_coin2.png') }}" alt="Coin Verso" class="coin-img">
                    </div>
                    <h3 class="text-4xl font-charming shimmer-gold mb-4">Challenge Coin</h3>
                    <p class="text-xl font-elegant italic tracking-wide text-gray-300 leading-relaxed">
                        A moeda da irmandade e tradição, entregue apenas àqueles que demonstraram bravura e lealdade ao Batalhão.
                    </p>
                </div>
                <div class="lg:col-span-2 text-left bg-gray-900/50 p-12 rounded-[40px] border border-white/5">
                    <h3 class="text-3xl font-serif-playfair font-bold mb-6 text-white">Heráldica & Brasões</h3>
                    <p class="text-lg text-gray-400 mb-8 leading-relaxed font-serif-playfair">
                        Nossos símbolos representam a autoridade e a presença do Estado nas rodovias. A <strong>Asa Rodoviária</strong>, 
                        em conjunto com as cores de nossa bandeira, simboliza a rapidez e a firmeza no socorro e fiscalização.
                    </p>
                    <div class="grid grid-cols-2 gap-8">
                        <div>
                            <h4 class="font-bold text-white border-l-4 border-gold pl-4 mb-2 font-serif-playfair" style="border-left-color: #d5aa32;">Ano de Criação</h4>
                            <p class="text-gray-500 font-serif-playfair">2008</p>
                        </div>
                        <div>
                            <h4 class="font-bold text-white border-l-4 border-gold pl-4 mb-2 font-serif-playfair" style="border-left-color: #d5aa32;">Lema Oficial</h4>
                            <p class="text-gray-500 font-serif-playfair">O GUARDIÃO DAS RODOVIAS DO SUDOESTE</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection