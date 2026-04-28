@extends('layouts.apple')

@section('title', 'Galeria e Memória | 5º BPRv')

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

    .font-serif-playfair { font-family: var(--font-serif) !important; }
    .font-charming { font-family: var(--font-charming) !important; }
    .font-elegant { font-family: var(--font-elegant) !important; }

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

    /* ── Mural de Heróis ── */
    .hero-card {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(213, 170, 50, 0.1);
        border-radius: 20px;
        padding: 2.5rem;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .hero-card:hover {
        background: rgba(255, 255, 255, 0.05);
        border-color: var(--galeria-gold);
        transform: translateY(-5px);
    }

    .hero-card::before {
        content: "";
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 4px;
        background: linear-gradient(90deg, transparent, var(--galeria-gold), transparent);
        opacity: 0;
        transition: opacity 0.4s;
    }

    .hero-card:hover::before {
        opacity: 1;
    }

    .historical-badge {
        display: inline-block;
        padding: 4px 12px;
        background: rgba(213, 170, 50, 0.1);
        color: var(--galeria-gold);
        border-radius: 100px;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 1.5rem;
    }

    /* ── Estética Retro Pioneiros ── */
    .retro-paper {
        background: #1a1a1a;
        border: 1px solid rgba(213, 170, 50, 0.2);
        padding: 3rem;
        border-radius: 4px;
        position: relative;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }

    .retro-paper::before {
        content: "";
        position: absolute;
        inset: 0;
        background: url('https://www.transparenttextures.com/patterns/pinstriped-suit.png'); /* Subtle grain */
        opacity: 0.05;
        pointer-events: none;
    }

    .retro-title {
        font-family: 'Barlow Condensed', sans-serif;
        font-weight: 900;
        font-size: 3.5rem;
        color: var(--galeria-gold);
        text-transform: uppercase;
        margin-bottom: 1.5rem;
        border-bottom: 2px solid var(--galeria-gold);
        display: inline-block;
    }

    .retro-photo-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    .retro-photo-item {
        background: #fff;
        padding: 8px 8px 30px 8px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.3);
        transform: rotate(var(--rotation, 0deg));
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .retro-photo-item:hover {
        transform: rotate(0deg) scale(1.1);
        z-index: 10;
        box-shadow: 0 20px 40px rgba(0,0,0,0.5);
    }

    .retro-photo-item img {
        width: 100%;
        aspect-ratio: 4/3;
        object-fit: cover;
        filter: sepia(0.4) contrast(1.1) brightness(0.9);
    }

    .retro-list {
        list-style: none;
        padding-left: 0;
    }

    .retro-list li {
        position: relative;
        padding-left: 1.5rem;
        margin-bottom: 0.75rem;
        color: #d1d1d1;
    }

    .retro-list li::before {
        content: "•";
        position: absolute;
        left: 0;
        color: var(--galeria-gold);
        font-weight: bold;
    }

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
        animation: rotate-slow 20s linear infinite;
    }

    @keyframes rotate-slow {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
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

    /* ── Dark Footer Override ── */
    footer {
        background-color: #080808 !important;
        background: #080808 !important;
        border-top: 1px solid rgba(255,255,255,0.05) !important;
        color: rgba(255,255,255,0.3) !important;
        margin-top: 0 !important;
    }

    footer p, footer small {
        color: rgba(255,255,255,0.3) !important;
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

    {{-- ── Seção Os Pioneiros de 1948 ── --}}
    <section class="py-24">
        <div class="max-w-7xl mx-auto px-4">
            <div class="retro-paper">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    
                    {{-- Texto Histórico --}}
                    <div>
                        <span class="text-gold font-bold uppercase tracking-widest text-xs mb-2 block">Legado e Tradição</span>
                        <h2 class="retro-title">Os Pioneiros de 1948</h2>
                        
                        <div class="space-y-6 text-gray-300 font-serif text-lg leading-relaxed">
                            <p>
                                📜 <strong>Fundação e Contexto Histórico</strong>
                            </p>
                            <p>
                                Em 10 de janeiro de 1948, nascia oficialmente o policiamento rodoviário no Estado de São Paulo, vinculado à então Força Pública do Estado de São Paulo, instituição que posteriormente daria origem à atual Polícia Militar.
                            </p>
                            <p>
                                O Brasil vivia um período de expansão da infraestrutura rodoviária, impulsionado pelo crescimento industrial e urbano do pós-guerra. A inauguração da <strong>Rodovia Anchieta (SP-150)</strong> representava um marco logístico e econômico, conectando o planalto ao porto de Santos — eixo vital para o desenvolvimento paulista.
                            </p>
                            <p>
                                Nesse cenário, surgia a necessidade de uma força especializada para:
                            </p>
                            <ul class="retro-list">
                                <li>Garantir a segurança dos usuários</li>
                                <li>Fiscalizar o tráfego ainda incipiente</li>
                                <li>Atuar em ocorrências e emergências rodoviárias</li>
                                <li>Preservar a ordem pública nas novas rodovias</li>
                            </ul>
                        </div>
                    </div>

                    {{-- Galeria Retro Mosaic --}}
                    <div class="retro-photo-grid">
                        <div class="retro-photo-item" style="--rotation: -3deg">
                            <img src="{{ asset('imagens/historico/pioneiros1.jpg') }}" alt="Pioneiros 1948">
                        </div>
                        <div class="retro-photo-item" style="--rotation: 2deg">
                            <img src="{{ asset('imagens/historico/pioneiros2.jpg') }}" alt="Equipamento de Época">
                        </div>
                        <div class="retro-photo-item" style="--rotation: -1deg">
                            <img src="{{ asset('imagens/historico/pioneiros3.jpg') }}" alt="Patrulhamento Histórico">
                        </div>
                        <div class="retro-photo-item" style="--rotation: 3deg">
                            <img src="{{ asset('imagens/historico/pioneiros4.jpg') }}" alt="Inauguração Anchieta">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    {{-- ── Seção Legado de Guerra - FEB ── --}}
    <section class="py-24" style="padding-top: 0;">
        <div class="max-w-7xl mx-auto px-4">
            <div class="retro-paper">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    
                    {{-- Texto Histórico --}}
                    <div>
                        <span class="text-gold font-bold uppercase tracking-widest text-xs mb-2 block">Honra e Bravura</span>
                        <h2 class="retro-title">Legado de Guerra — A FEB</h2>
                        
                        <div class="space-y-6 text-gray-300 font-serif text-lg leading-relaxed">
                            <p>
                                🎖️ <strong>Veteranos da Itália</strong>
                            </p>
                            <p>
                                Grande parte dos primeiros patrulheiros rodoviários era formada por ex-combatentes da:
                            </p>
                            <p class="text-gold font-bold text-2xl font-heading uppercase tracking-wider">
                                👉 Força Expedicionária Brasileira (FEB)
                            </p>
                            <p>
                                A FEB participou da Segunda Guerra Mundial, combatendo na Itália entre 1944 e 1945 ao lado dos Aliados.
                            </p>
                            
                            <p>
                                🧠 <strong>Influência Militar na Polícia Rodoviária</strong>
                            </p>
                            <p>
                                Esses veteranos trouxeram valores fundamentais que foram decisivos para moldar a identidade da corporação:
                            </p>
                            <ul class="retro-list">
                                <li>Disciplina militar rígida</li>
                                <li>Espírito de corpo (camaradagem)</li>
                                <li>Resiliência em situações adversas</li>
                                <li>Tomada de decisão sob pressão</li>
                                <li>Organização tática</li>
                            </ul>

                            <p>
                                🪖 <strong>Impacto direto na doutrina</strong>
                            </p>
                            <p>
                                A atuação desses ex-combatentes contribuiu diretamente para a estruturação inicial do patrulhamento, a padronização de condutas operacionais e a formação de uma tropa altamente confiável, focada em missão e honra.
                            </p>
                        </div>
                    </div>

                    {{-- Galeria Retro Mosaic --}}
                    <div class="retro-photo-grid">
                        <div class="retro-photo-item" style="--rotation: -2deg">
                            <img src="{{ asset('imagens/historico/veteranos_italia4.jpg') }}" alt="FEB Veteranos">
                        </div>
                        <div class="retro-photo-item" style="--rotation: 3deg">
                            <img src="{{ asset('imagens/historico/veteranos_italia.jpg') }}" alt="Marcha da FEB">
                        </div>
                        <div class="retro-photo-item" style="--rotation: -1deg">
                            <img src="{{ asset('imagens/historico/veteranos_italia3.jpg') }}" alt="Acampamento na Itália">
                        </div>
                        <div class="retro-photo-item" style="--rotation: 2deg">
                            <img src="{{ asset('imagens/historico/veteranos_italia2.jpg') }}" alt="Símbolo da FEB">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    {{-- ── Seção Liderança Fundadora ── --}}
    <section class="py-24" style="padding-top: 0;">
        <div class="max-w-7xl mx-auto px-4">
            <div class="retro-paper">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    
                    {{-- Texto Histórico --}}
                    <div>
                        <span class="text-gold font-bold uppercase tracking-widest text-xs mb-2 block">Liderança e Evolução</span>
                        <h2 class="retro-title">Liderança Fundadora</h2>
                        
                        <div class="space-y-6 text-gray-300 font-serif text-lg leading-relaxed">
                            <p>
                                🧭 <strong>O Primeiro Comando</strong>
                            </p>
                            <p>
                                O primeiro comando da tropa rodoviária ficou sob responsabilidade do:
                            </p>
                            <p class="text-gold font-bold text-2xl font-heading uppercase tracking-wider">
                                👉 Tenente Pina
                            </p>
                            <p>
                                Oficial da Força Pública, ele foi responsável por organizar o efetivo inicial, definir as primeiras estratégias operacionais e estabelecer a disciplina da nova unidade.
                            </p>
                            
                            <p>
                                🏗️ <strong>Construção das Bases Operacionais</strong>
                            </p>
                            <p>
                                Sob sua liderança, foram estabelecidos pontos estratégicos de patrulhamento, rotinas de fiscalização e procedimentos de abordagem que transformaram um grupo inicial em uma estrutura permanente de segurança viária.
                            </p>

                            <h3 class="text-2xl font-heading font-bold text-white mt-8 mb-4">🧱 EVOLUÇÃO HISTÓRICA</h3>
                            <p class="text-gold font-bold">📈 Da Patrulha à Polícia Especializada</p>
                            <ul class="retro-list">
                                <li><strong>Décadas de 1950–1970:</strong> Expansão da malha rodoviária, aumento do efetivo e consolidação institucional.</li>
                                <li><strong>Décadas de 1980–2000:</strong> Modernização de viaturas, introdução de rádios e sistemas de comunicação e especialização em acidentes.</li>
                                <li><strong>Século XXI:</strong> Uso de tecnologia de ponta (radares, sistemas integrados), inteligência policial e operações de grande escala.</li>
                            </ul>
                        </div>
                    </div>

                    {{-- Galeria Retro Mosaic --}}
                    <div class="retro-photo-grid">
                        <div class="retro-photo-item" style="--rotation: 3deg">
                            <img src="{{ asset('imagens/historico/pina.jpg') }}" alt="Tenente Pina em Operação">
                        </div>
                        <div class="retro-photo-item" style="--rotation: -2deg">
                            <img src="{{ asset('imagens/historico/pina2.jpg') }}" alt="Formação Inicial">
                        </div>
                        <div class="retro-photo-item" style="--rotation: 1deg">
                            <img src="{{ asset('imagens/historico/pina3.jpg') }}" alt="Viatura de Época">
                        </div>
                        <div class="retro-photo-item" style="--rotation: -3deg">
                            <img src="{{ asset('imagens/historico/pina4.jpg') }}" alt="Legado Institucional">
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
                    <div class="coin-container">
                        <img src="{{ asset('imagens/logos/logo_cois1.png') }}" alt="Coin Frente" class="coin-img">
                        <img src="{{ asset('imagens/logos/logo_coin2.png') }}" alt="Coin Verso" class="coin-img">
                    </div>
                    <h3 class="text-4xl font-charming shimmer-gold mb-4">Challenge Coin</h3>
                    <p class="text-xl font-elegant italic tracking-wide text-gray-300 leading-relaxed">
                        A moeda da irmandade e tradição, entregue apenas àqueles que demonstraram bravura e lealdade ao Batalhão.
                    </p>
                </div>

                {{-- Brasao --}}
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
