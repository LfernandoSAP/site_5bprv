@extends('layouts.apple')

@section('title', 'Galeria e Memória | 5º BPRv')

@section('styles')
<style>
    /* ── Variáveis de Identidade ── */
    :root {
        --galeria-gold: #d5aa32;
        --galeria-black: #111111;
        --galeria-dark: #1a1a1a;
        --galeria-text: #ffffff;
    }

    html body {
        background-color: var(--galeria-black) !important;
        background: var(--galeria-black) !important;
        color: var(--galeria-text);
    }

    /* ── Hero Especial (Inspirada no Histórico) ── */
    .galeria-hero {
        position: relative;
        height: 50vh;
        min-height: 400px;
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
        background: #ffffff;
        border-radius: 12px;
        padding: 10px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        border: 1px solid rgba(0,0,0,0.05);
        transition: all 0.4s ease;
        text-align: center;
    }

    .portrait-frame:hover {
        transform: translateY(-10px);
        border-color: var(--galeria-gold);
        box-shadow: 0 30px 60px rgba(213, 170, 50, 0.15);
    }

    .portrait-placeholder {
        width: 100%;
        aspect-ratio: 3/4;
        background: linear-gradient(135deg, #1a1a1a 0%, #333 100%);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        position: relative;
        overflow: hidden;
    }

    .portrait-placeholder::after {
        content: "";
        position: absolute;
        inset: 0;
        border: 2px solid rgba(213, 170, 50, 0.2);
        border-radius: 8px;
    }

    .portrait-placeholder svg {
        width: 40%;
        opacity: 0.15;
        fill: var(--galeria-gold);
    }

    .commander-name {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 1.1rem;
        font-weight: 800;
        color: #ffffff;
        text-transform: uppercase;
        margin-top: 0.5rem;
    }

    .commander-rank {
        font-size: 0.75rem;
        color: #888;
        font-weight: 600;
        letter-spacing: 1px;
    }

    /* ── Memorial Vigilante Rodoviário ── */
    .memorial-banner {
        background: linear-gradient(135deg, #1a1a1a 0%, #000000 100%);
        border-radius: 30px;
        padding: 4rem;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .memorial-banner::after {
        content: "";
        position: absolute;
        top: -10%; right: -5%;
        width: 300px; height: 300px;
        background: rgba(213, 170, 50, 0.05);
        border-radius: 50%;
        filter: blur(60px);
    }

    /* ── Seção Challenge Coin ── */
    .coin-ring {
        width: 180px;
        height: 180px;
        border-radius: 50%;
        border: 4px dashed var(--galeria-gold);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 10px;
        margin: 0 auto 2rem;
    }

    .coin-inner {
        width: 100%;
        height: 100%;
        background: var(--galeria-gold);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: inset 0 0 20px rgba(0,0,0,0.2), 0 10px 30px rgba(213, 170, 50, 0.3);
    }
</style>
@endsection

@section('content')
<div style="background-color: var(--galeria-black);">
    
    {{-- ── Hero Section ── --}}
    <section class="galeria-hero">
        <div class="px-4">
            <h1 class="shimmer-text font-heading mb-4">Galeria e Memória</h1>
            <p class="font-light tracking-[0.3em] uppercase opacity-80 text-sm md:text-base">
                Preservando o Legado dos Guardiões do Sudoeste
            </p>
        </div>
    </section>

    {{-- ── Galeria de Eternos Comandantes ── --}}
    <section class="py-24">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-heading font-bold text-white mb-4">Eternos Comandantes</h2>
                <div class="w-20 h-1 bg-[#d5aa32] mx-auto mb-6"></div>
                <p class="text-gray-500 max-w-2xl mx-auto font-serif italic text-lg">
                    "Lideranças que moldaram a história do 5º BPRv com honra, disciplina e dedicação ao policiamento rodoviário."
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                @php
                    $comandantes = [
                        'Ten Cel PM Quarterone', 'Ten Cel PM Ramiro', 'Ten Cel PM Cação', 
                        'Ten Cel PM Marcondes', 'Ten Cel PM Frank', 'Ten Cel PM Michelazzo',
                        'Ten Cel PM Julião', 'Ten Cel PM Carvalho', 'Ten Cel PM Infanti',
                        'Ten Cel PM Menemilton', 'Ten Cel PM Hugo', 'Ten Cel PM Marcel'
                    ];
                @endphp

                @foreach($comandantes as $nome)
                <div class="portrait-frame">
                    <div class="portrait-placeholder">
                        <svg viewBox="0 0 448 512">
                            <path d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"/>
                        </svg>
                    </div>
                    <p class="commander-rank">Eterno Comandante</p>
                    <h4 class="commander-name">{{ str_replace('Ten Cel PM ', '', $nome) }}</h4>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── Memorial O Vigilante Rodoviário ── --}}
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4">
            <div class="memorial-banner">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div class="text-center lg:text-left">
                        <span class="text-gold font-bold uppercase tracking-widest text-sm">Memorial de Identidade</span>
                        <h2 class="text-5xl font-heading font-bold mt-4 mb-6">O Vigilante Rodoviário</h2>
                        <p class="text-xl opacity-80 leading-relaxed mb-8 font-serif">
                            Carlos Miranda, o eterno <strong>Ten Cel PM Carlos Miranda</strong>, imortalizou o policiamento nas estradas 
                            como o primeiro herói da TV brasileira, tornando-se oficial da vida real neste Batalhão.
                        </p>
                        <ul class="space-y-4 text-gray-400">
                            <li class="flex items-center gap-3">
                                <span class="text-gold">✓</span> Mais que um personagem, um símbolo de civismo.
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="text-gold">✓</span> Acervo histórico preservado no Comando de Policiamento.
                            </li>
                        </ul>
                    </div>
                    <div class="relative">
                        <div class="bg-gray-800 aspect-video rounded-2xl overflow-hidden shadow-2xl flex items-center justify-center border-4 border-gray-700">
                             <p class="text-gray-500 font-bold italic">Acervo Carlos Miranda</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ── Seção Challenge Coin e Brasoes ── --}}
    <section class="py-24" style="background-color: #0d0d0d;">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-16 text-center">
                
                {{-- Coin --}}
                <div class="lg:col-span-1">
                    <div class="coin-ring">
                        <div class="coin-inner">
                            <span class="text-white text-5xl font-bold">5º</span>
                        </div>
                    </div>
                    <h3 class="text-2xl font-heading font-bold mb-4 text-white">Challenge Coin</h3>
                    <p class="text-gray-400 font-body">
                        A moeda da irmandade e tradição, entregue apenas àqueles que demonstraram bravura e lealdade ao Batalhão.
                    </p>
                </div>

                {{-- Brasao --}}
                <div class="lg:col-span-2 text-left bg-gray-900/50 p-12 rounded-[40px] border border-white/5">
                    <h3 class="text-3xl font-heading font-bold mb-6 text-white">Heráldica & Brasoes</h3>
                    <p class="text-lg text-gray-400 mb-8 leading-relaxed">
                        Nossos símbolos representam a autoridade e a presença do Estado nas rodovias. A <strong>Asa Rodoviária</strong>, 
                        em conjunto com as cores de nossa bandeira, simboliza a rapidez e a firmeza no socorro e fiscalização.
                    </p>
                    <div class="grid grid-cols-2 gap-8">
                        <div>
                            <h4 class="font-bold text-white border-l-4 border-gold pl-4 mb-2">Ano de Criação</h4>
                            <p class="text-gray-500">10 de Janeiro de 1948</p>
                        </div>
                        <div>
                            <h4 class="font-bold text-white border-l-4 border-gold pl-4 mb-2">Lema Oficial</h4>
                            <p class="text-gray-500">Guardião do Sudoeste</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</div>
@endsection
