@extends('layouts.apple')

@section('title', 'T.O.R. - Tático Ostensivo Rodoviário | 5º BPRv')

@section('styles')
<style>
    /* ── Variáveis Táticas ── */
    :root {
        --tor-gold: #d5aa32;
        --tor-black: #080808;
        --tor-gray: #1a1a1a;
        --tor-steel: #2c2c2e;
        --tor-text-gray: #a1a1a6;
    }

    html body {
        background-color: var(--tor-black) !important;
        background: var(--tor-black) !important;
        color: #ffffff;
    }

    /* ── Hero TOR ── */
    .tor-hero {
        height: 75vh;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        background: radial-gradient(circle at center, rgba(213, 170, 50, 0.1), transparent 70%);
    }

    .tor-hero-content {
        text-align: center;
        z-index: 10;
        max-width: 900px;
        padding: 0 20px;
    }

    .tor-logo-big {
        width: 140px;
        height: auto;
        margin-bottom: 2rem;
        filter: drop-shadow(0 0 20px rgba(213, 170, 50, 0.4));
        animation: logoPulse 4s ease-in-out infinite;
    }

    @keyframes logoPulse {
        0%, 100% { transform: scale(1); filter: drop-shadow(0 0 20px rgba(213, 170, 50, 0.4)); }
        50% { transform: scale(1.05); filter: drop-shadow(0 0 35px rgba(213, 170, 50, 0.6)); }
    }

    .tor-title {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: clamp(3.5rem, 8vw, 6.5rem);
        font-weight: 900;
        letter-spacing: -3px;
        line-height: 0.95;
        margin-bottom: 1.5rem;
        text-transform: uppercase;
        background: linear-gradient(to bottom, #ffffff 50%, #666666);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .tor-subtitle {
        font-size: 1.25rem;
        color: var(--tor-gold);
        letter-spacing: 6px;
        text-transform: uppercase;
        font-weight: 800;
        margin-bottom: 3rem;
    }

    /* ── Grid de Missões ── */
    .mission-grid {
        display: grid;
        grid-template-cols: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        max-width: 1200px;
        margin: -100px auto 100px;
        padding: 0 20px;
        position: relative;
        z-index: 20;
    }

    .mission-card {
        background: rgba(26, 26, 26, 0.8);
        backdrop-filter: blur(20px);
        padding: 40px;
        border-radius: 28px;
        border: 1px solid rgba(255,255,255,0.05);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .mission-card:hover {
        transform: translateY(-10px);
        border-color: var(--tor-gold);
        box-shadow: 0 30px 60px rgba(0,0,0,0.6);
    }

    .mission-icon {
        font-size: 2.5rem;
        margin-bottom: 20px;
        display: block;
    }

    .mission-name {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 15px;
        color: #fff;
    }

    .mission-desc {
        color: var(--tor-text-gray);
        line-height: 1.6;
        font-size: 0.95rem;
    }

    /* ── Seção de Impacto ── */
    .impact-section {
        background-color: #111;
        padding: 120px 0;
        position: relative;
        overflow: hidden;
    }

    .impact-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        display: grid;
        grid-template-cols: 1fr 1fr;
        gap: 80px;
        align-items: center;
    }

    .impact-text h2 {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 2rem;
        line-height: 1.1;
    }

    .impact-text p {
        color: var(--tor-text-gray);
        font-size: 1.1rem;
        line-height: 1.8;
        margin-bottom: 2.5rem;
    }

    .stat-grid {
        display: grid;
        grid-template-cols: 1fr 1fr;
        gap: 30px;
    }

    .stat-item {
        border-left: 3px solid var(--tor-gold);
        padding-left: 20px;
    }

    .stat-value {
        font-size: 2.5rem;
        font-weight: 800;
        color: #fff;
    }

    .stat-label {
        font-size: 0.85rem;
        text-transform: uppercase;
        color: var(--tor-gold);
        letter-spacing: 2px;
    }

    /* ── Background Elements ── */
    .bg-shield {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 80vh;
        opacity: 0.03;
        z-index: 1;
        pointer-events: none;
    }

    /* ── Mosaico Operacional ── */
    .tor-gallery {
        max-width: 1400px;
        margin: 100px auto;
        padding: 0 20px;
    }

    .bento-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        grid-template-rows: repeat(2, 300px);
        gap: 20px;
    }

    .bento-item {
        position: relative;
        border-radius: 24px;
        overflow: hidden;
        border: 1px solid rgba(255,255,255,0.1);
        cursor: pointer;
        transition: all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .bento-item:hover {
        transform: scale(1.02);
        border-color: var(--tor-gold);
        z-index: 5;
    }

    .bento-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: brightness(0.8) contrast(1.1);
        transition: all 0.5s ease;
    }

    .bento-item:hover img {
        filter: brightness(1.1) contrast(1.1);
    }

    .item-large { grid-column: span 2; grid-row: span 2; }
    .item-wide { grid-column: span 2; }

    .bento-caption {
        position: absolute;
        bottom: 0; left: 0; right: 0;
        padding: 20px;
        background: linear-gradient(transparent, rgba(0,0,0,0.8));
        color: white;
        font-size: 0.85rem;
        opacity: 0;
        transform: translateY(10px);
        transition: all 0.3s ease;
    }

    .bento-item:hover .bento-caption {
        opacity: 1;
        transform: translateY(0);
    }

    /* ── Lightbox Styles ── */
    .lightbox-overlay {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0, 0, 0, 0.95);
        backdrop-filter: blur(10px);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 10000;
        cursor: zoom-out;
    }

    .lightbox-img {
        max-width: 90%;
        max-height: 85vh;
        border-radius: 12px;
        box-shadow: 0 0 50px rgba(0,0,0,0.8);
        border: 1px solid rgba(255,255,255,0.1);
        transform: scale(0.9);
        transition: transform 0.3s ease;
    }

    .lightbox-close {
        position: absolute;
        top: 30px; right: 30px;
        color: var(--tor-gold);
        font-size: 40px;
        cursor: pointer;
        font-weight: 300;
    }

    /* ── Responsive ── */
    @media (max-width: 900px) {
        .bento-grid {
            grid-template-columns: 1fr;
            grid-template-rows: auto;
        }
        .item-large, .item-wide { grid-column: span 1; grid-row: span 1; }
        .bento-grid > div { height: 300px; }
        .impact-content {
            grid-template-cols: 1fr;
            text-align: center;
        }
    }
</style>
@endsection

@section('content')
<main>
    <!-- Logo de fundo desfocada -->
    <img src="{{ asset('imagens/logos/logo_tor.png') }}" class="bg-shield" alt="">

    <!-- Hero TOR -->
    <section class="tor-hero">
        <div class="tor-hero-content">
            <img src="{{ asset('imagens/logos/logo_tor.png') }}" class="tor-logo-big" alt="Logo TOR">
            <p class="tor-subtitle">Tático Ostensivo Rodoviário</p>
            <h1 class="tor-title">TÁTICO OSTENSIVO<br>RODOVIÁRIO</h1>
        </div>
    </section>

    <!-- Cards de Missão -->
    <section class="mission-grid">
        <div class="mission-card">
            <span class="mission-icon">⚡</span>
            <h3 class="mission-name">Pronta Resposta</h3>
            <p class="mission-desc">
                Intervenção imediata em ocorrências de alto risco. O TOR é acionado quando a precisão técnica e a superioridade tática são indispensáveis.
            </p>
        </div>

        <div class="mission-card">
            <span class="mission-icon">🎯</span>
            <h3 class="mission-name">Combate ao Crime</h3>
            <p class="mission-desc">
                Especialistas em interceptação de ilícitos, tráfico de drogas e armas. Vigilância constante nos corredores logísticos do Sudoeste Paulista.
            </p>
        </div>

        <div class="mission-card">
            <span class="mission-icon">🛡️</span>
            <h3 class="mission-name">Patrulhamento</h3>
            <p class="mission-desc">
                Presença ostensiva em pontos estratégicos. A doutrina de patrulhamento tático garante a segurança em condições de extrema adversidade.
            </p>
        </div>
    </section>

    <!-- Seção de Estatísticas e Impacto -->
    <section class="impact-section">
        <div class="impact-content">
            <div class="impact-text">
                <h2>O Braço Forte da Lei nas Estradas</h2>
                <p>
                    Composto por policiais selecionados sob rigorosos critérios técnicos e físicos, o Tático Ostensivo Rodoviário (TOR) do 5º BPRv é referência nacional em policiamento especializado. Nossa missão é garantir que a lei prevaleça, não importa o terreno ou a ameaça.
                </p>
                <div class="stat-grid">
                    <div class="stat-item">
                        <div class="stat-value">24h</div>
                        <div class="stat-label">Vigilância</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">100%</div>
                        <div class="stat-label">Compromisso</div>
                    </div>
                </div>
            </div>
            <div class="relative">
                <div style="background: linear-gradient(135deg, #1a1a1a, #000); border-radius: 24px; padding: 10px; border: 1px solid rgba(213, 170, 50, 0.2);">
                    <img src="{{ asset('imagens/TOR/SgtRichard.jpeg') }}" alt="Sgt Richard - TOR" style="width: 100%; border-radius: 16px; filter: grayscale(1) contrast(1.2);">
                    <p class="text-xs text-center mt-4 opacity-40 uppercase tracking-widest">Doutrina • Força • Honra</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Mosaico Operacional -->
    <section class="tor-gallery">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-heading font-bold uppercase tracking-widest text-[#d5aa32]">Mosaico Operacional</h2>
            <div class="w-24 h-1 bg-[#d5aa32] mx-auto mt-4 opacity-30"></div>
        </div>

        <div class="bento-grid">
            <div class="bento-item item-large">
                <img src="{{ asset('imagens/TOR/SgtBarrosEquipe3.jpeg') }}" alt="Equipe TOR em ação">
                <div class="bento-caption">Patrulhamento Tático Operacional</div>
            </div>
            <div class="bento-item item-wide">
                <img src="{{ asset('imagens/TOR/SgtBarrosEquipe1.jpeg') }}" alt="TOR News">
                <div class="bento-caption">OPERAÇÃO CONJUNTA PARA PROTEGER A SOCIEDADE</div>
            </div>
            <div class="bento-item">
                <img src="{{ asset('imagens/TOR/SgtBarrosEquipe2.jpeg') }}" alt="Viatura TOR">
                <div class="bento-caption">Equipamento de Ponta para Resposta Rápida</div>
            </div>
            <div class="bento-item">
                <img src="{{ asset('imagens/TOR/SgtRichard2.jpeg') }}" alt="Sgt Richard - Memória TOR">
                <div class="bento-caption">FORÇA E HONRA</div>
            </div>
        </div>
    </section>

    <!-- Slogan Final -->
    <section class="py-32 text-center bg-black">
        <h2 class="slogan-history" style="font-family: 'Barlow Condensed', sans-serif; font-size: 3.5rem; font-weight: 900; opacity: 0.9;">
            T.O.R. — SEGURANÇA NAS RODOVIAS PAULISTAS.
        </h2>
    </section>

    <!-- Lightbox Structure -->
    <div id="torLightbox" class="lightbox-overlay">
        <span class="lightbox-close">&times;</span>
        <img class="lightbox-img" id="lightboxImg" src="">
    </div>

</main>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const lightbox = document.getElementById('torLightbox');
        const lightboxImg = document.getElementById('lightboxImg');
        const closeBtn = document.querySelector('.lightbox-close');
        const images = document.querySelectorAll('.bento-item img, .impact-content img');

        images.forEach(img => {
            img.style.cursor = 'zoom-in';
            img.addEventListener('click', () => {
                lightboxImg.src = img.src;
                lightbox.style.display = 'flex';
                setTimeout(() => {
                    lightboxImg.style.transform = 'scale(1)';
                }, 10);
            });
        });

        const closeLightbox = () => {
            lightboxImg.style.transform = 'scale(0.9)';
            setTimeout(() => {
                lightbox.style.display = 'none';
            }, 200);
        };

        closeBtn.addEventListener('click', closeLightbox);
        lightbox.addEventListener('click', (e) => {
            if (e.target === lightbox) closeLightbox();
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && lightbox.style.display === 'flex') {
                closeLightbox();
            }
        });
    });
</script>
@endsection
