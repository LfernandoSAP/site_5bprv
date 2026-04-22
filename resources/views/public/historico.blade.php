@extends('layouts.apple')

@section('title', 'Histórico | 5º BPRv - Polícia Rodoviária')

@section('styles')
<style>
    /* ── Variáveis de Design ── */
    :root {
        --history-gold: #d5aa32;
        --history-black: #111111;
        --history-dark-gray: #1a1a1a;
        --history-white: #ffffff;
    }

    html body {
        background-color: var(--history-black) !important;
        background: var(--history-black) !important;
        color: var(--history-white);
    }

    /* ── Hero Section ── */
    .hero-history {
        height: 60vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        background: radial-gradient(circle at center, rgba(213, 170, 50, 0.15), transparent 70%), #111111;
        position: relative;
        overflow: hidden;
    }

    .hero-history h1 {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: clamp(3rem, 10vw, 6rem);
        font-weight: 900;
        letter-spacing: -2px;
        line-height: 0.9;
        margin-bottom: 20px;
        background: linear-gradient(to bottom, #fff 40%, rgba(255,255,255,0.4));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .hero-history p {
        font-size: 1.15rem;
        color: var(--history-gold);
        letter-spacing: 4px;
        text-transform: uppercase;
        font-weight: 600;
        margin-bottom: 5px;
    }

    /* ── Hero Image Cards ── */
    .hero-images-container {
        display: flex;
        align-items: center;
        gap: 60px;
        width: 100%;
        max-width: 1400px;
        justify-content: center;
        padding: 0 40px;
    }

    .hero-image-card {
        width: 220px;
        flex-shrink: 0;
        text-align: center;
        transition: all 0.4s ease;
    }

    .hero-image-card:hover {
        transform: translateY(-8px) scale(1.03);
    }

    .hero-image-card img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-radius: 20px;
        border: 1px solid #000;
        box-shadow: 0 15px 35px rgba(0,0,0,0.5);
        margin-bottom: 12px;
    }

    .hero-image-card span {
        display: block;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: rgba(255,255,255,0.4);
        font-weight: 700;
    }

    @media (max-width: 1100px) {
        .hero-image-card {
            display: none;
        }
    }

    /* ── Timeline Structure ── */
    .timeline-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 80px 20px;
        position: relative;
    }

    .timeline-line {
        position: absolute;
        left: 50%;
        top: 0;
        bottom: 0;
        width: 2px;
        background: linear-gradient(to bottom, transparent, var(--history-gold), transparent);
        transform: translateX(-50%);
    }

    .timeline-event {
        margin-bottom: 120px;
        position: relative;
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .timeline-event:nth-child(even) {
        flex-direction: row-reverse;
    }

    .timeline-content {
        width: 45%;
        padding: 40px;
        background: var(--history-dark-gray);
        border-radius: 24px;
        border: 1px solid rgba(255,255,255,0.05);
        box-shadow: 0 20px 40px rgba(0,0,0,0.4);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        position: relative;
    }

    .timeline-content:hover {
        transform: translateY(-10px);
        border-color: var(--history-gold);
        box-shadow: 0 30px 60px rgba(0,0,0,0.6), 0 0 20px rgba(213, 170, 50, 0.1);
    }

    .timeline-dot {
        position: absolute;
        left: 50%;
        top: 50%;
        width: 20px;
        height: 20px;
        background: var(--history-black);
        border: 4px solid var(--history-gold);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        z-index: 10;
        box-shadow: 0 0 15px var(--history-gold);
    }

    .timeline-year {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 4rem;
        font-weight: 900;
        color: rgba(255,255,255,0.05);
        position: absolute;
        top: -30px;
        left: 40px;
        z-index: 0;
    }

    .timeline-event:nth-child(even) .timeline-year {
        left: auto;
        right: 40px;
    }

    .event-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--history-white);
        margin-bottom: 15px;
        position: relative;
        z-index: 1;
    }

    .event-description {
        color: rgba(255,255,255,0.65);
        line-height: 1.6;
        font-size: 1rem;
    }

    .event-image {
        width: 100%;
        height: 250px;
        border-radius: 16px;
        object-fit: cover;
        margin-bottom: 20px;
        border: 1px solid rgba(255,255,255,0.1);
    }

    /* ── Special Cards ── */
    .special-card-tor {
        background: linear-gradient(135deg, #1a1a1a 0%, #000 100%) !important;
        border-left: 4px solid #d5aa32 !important;
    }

    .special-card-tor .event-title {
        color: #d5aa32;
    }

    /* ── Responsive ── */
    @media (max-width: 768px) {
        .timeline-line {
            left: 20px;
        }
        .timeline-event, .timeline-event:nth-child(even) {
            flex-direction: column;
            align-items: flex-start;
            padding-left: 50px;
        }
        .timeline-content {
            width: 100%;
        }
        .timeline-dot {
            left: 20px;
        }
        .timeline-year {
            font-size: 3rem;
            top: -20px;
            left: 20px;
        }
    }

    /* ── Animation Esquerda/Direita (Slogan Style) ── */
    .slogan-history {
        background: linear-gradient(90deg, #111110, #242218, #6b664c, #6e6320, #cfaf21);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        background-size: 300% auto;
        animation: brilhoSloganLR 5s linear infinite;
    }

    @keyframes brilhoSloganLR {
        0%   { background-position: 300% center; }
        100% { background-position: 0% center; }
    }

    /* ── Lightbox (Image Popup) ── */
    .event-image, .hero-image-card img {
        cursor: pointer;
        transition: filter 0.3s ease;
    }

    .event-image:hover, .hero-image-card img:hover {
        filter: brightness(1.1);
    }

    #imageLightbox {
        display: none;
        position: fixed;
        z-index: 10000;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background-color: rgba(0, 0, 0, 0.95);
        backdrop-filter: blur(10px);
        align-items: center;
        justify-content: center;
        flex-direction: column;
        animation: fadeIn 0.3s ease;
    }

    #imageLightbox.active {
        display: flex;
    }

    .lightbox-content {
        max-width: 90%;
        max-height: 85%;
        border-radius: 12px;
        box-shadow: 0 0 50px rgba(0,0,0,0.8);
        border: 1px solid rgba(255,255,255,0.1);
        transform: scale(0.9);
        animation: zoomIn 0.3s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
    }

    .lightbox-close {
        position: absolute;
        top: 30px;
        right: 40px;
        color: var(--history-gold);
        font-size: 50px;
        font-weight: 200;
        cursor: pointer;
        transition: transform 0.2s ease;
    }

    .lightbox-close:hover {
        transform: scale(1.2) rotate(90deg);
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes zoomIn {
        from { transform: scale(0.9); }
        to { transform: scale(1); }
    }

    body.lightbox-open {
        overflow: hidden;
    }
</style>
@endsection

@section('content')
<main>
    <!-- Hero Section -->
    <section class="hero-history">
        <div class="hero-images-container">
            <!-- Sede Inauguração -->
            <div class="hero-image-card">
                <img src="{{ asset('imagens/historico/primeirasede5bprv.jpg') }}" alt="Inauguração 5º BPRv" style="object-position: center;">
                <span>Inauguração (2008)</span>
            </div>

            <!-- Título Central -->
            <div style="flex: 1; text-align: center;">
                <p>A História do Policiamento Rodoviário</p>
                <h1>MEMÓRIA INSTITUCIONAL</h1>
            </div>

            <!-- Sede Atual -->
            <div class="hero-image-card">
                <img src="{{ asset('imagens/historico/fachada_2026.jpg') }}" alt="Sede Atual 5º BPRv" style="object-position: center;">
                <span>Sede Atual (2016)</span>
            </div>
        </div>
    </section>

    <!-- Timeline Wrapper -->
    <section class="timeline-container">
        <div class="timeline-line"></div>

        <!-- 1961 - O Vigilante Rodoviário -->
        <div class="timeline-event">
            <div class="timeline-dot"></div>
            <div class="timeline-content">
                <span class="timeline-year">1961</span>
                <img src="{{ asset('imagens/historico/carlos_miranda1.jpg') }}" class="event-image" alt="Vigilante Rodoviário" style="object-position: center 17%;">
                <h3 class="event-title">O Vigilante Rodoviário</h3>
                <p class="event-description">
                    Estreia o seriado de Carlos Miranda, o primeiro em toda a América Latina. 
                    A série imortalizou a figura do Policial Rodoviário e inspirou gerações. 
                    O ator mais tarde tornou-se oficial da PMESP, integrando a história real da corporação.
                </p>
            </div>
            <div style="width: 45%;"></div>
        </div>

        <!-- 1974 - Motocicletas Clássicas -->
        <div class="timeline-event">
            <div class="timeline-dot"></div>
            <div class="timeline-content">
                <span class="timeline-year">1974</span>
                <img src="{{ asset('imagens/historico/moto_bmw_1974.jpeg') }}" class="event-image" alt="Motos Clássicas" style="object-position: center 17%;">
                <h3 class="event-title">A Era das Duas Rodas</h3>
                <p class="event-description">
                    As motocicletas BMW de 1974 tornaram-se ícones da agilidade e força do Policiamento Rodoviário. 
                    A presença nas rodovias paulistas ganhava uma nova dinâmica de patrulhamento e escolta.
                </p>
            </div>
            <div style="width: 45%;"></div>
        </div>

        <!-- 1980s - Viaturas de Época -->
        <div class="timeline-event">
            <div class="timeline-dot"></div>
            <div class="timeline-content">
                <span class="timeline-year">1980</span>
                <img src="{{ asset('imagens/historico/opala.jpg') }}" class="event-image" alt="Opala PMESP">
                <h3 class="event-title">O Poder do Opala</h3>
                <p class="event-description">
                    A década de 80 foi marcada pelo patrulhamento das icônicas viaturas Opala, conhecidas pela sua velocidade e presença imponente nas rodovias. 
                    Um símbolo de autoridade e segurança pública.
                </p>
            </div>
            <div style="width: 45%;"></div>
        </div>

        <!-- 1986 - Academia e Instrução -->
        <div class="timeline-event">
            <div class="timeline-dot"></div>
            <div class="timeline-content">
                <span class="timeline-year">1986</span>
                <img src="{{ asset('imagens/historico/FOTO EQUIPE GT-CPRV 1986.jpg') }}" class="event-image" alt="Equipe GT">
                <h3 class="event-title">Gabinete de Treinamento</h3>
                <p class="event-description">
                    A formação de excelência sempre foi um pilar do Comando de Policiamento Rodoviário. 
                    Em 1986, as equipes de treinamento focavam na modernização dos procedimentos operacionais e táticos.
                </p>
            </div>
            <div style="width: 45%;"></div>
        </div>

        <!-- 1987 - Nascimento do TOR -->
        <div class="timeline-event">
            <div class="timeline-dot"></div>
            <div class="timeline-content special-card-tor">
                <span class="timeline-year">1987</span>
                <img src="{{ asset('imagens/historico/tor_antiga.jpeg') }}" class="event-image" alt="Fundação do TOR">
                <h3 class="event-title">A Elite das Estradas: T.O.R.</h3>
                <p class="event-description">
                    Nascido para combater o crime organizado e garantir a lei em situações críticas, 
                    o Tático Ostensivo Rodoviário surge como a força de elite do batalhão. 
                    Rapidez, letalidade técnica e disciplina inabalável.
                </p>
            </div>
            <div style="width: 45%;"></div>
        </div>

        <!-- 1991 - Raposo Tavares -->
        <div class="timeline-event">
            <div class="timeline-dot"></div>
            <div class="timeline-content">
                <span class="timeline-year">1991</span>
                <img src="{{ asset('imagens/historico/raposo_tavares_1991.jpeg') }}" class="event-image" alt="Raposo Tavares 1991">
                <h3 class="event-title">Consolidação Regional</h3>
                <p class="event-description">
                    O início dos anos 90 viu o policiamento na Rodovia Raposo Tavares se tornar o coração operacional da região de Sorocaba, 
                    preparando o terreno para o que viria a ser o 5º BPRv.
                </p>
            </div>
            <div style="width: 45%;"></div>
        </div>

        <!-- 2008 - Criação do 5º BPRv -->
        <div class="timeline-event">
            <div class="timeline-dot"></div>
            <div class="timeline-content">
                <span class="timeline-year">2008</span>
                <img src="{{ asset('imagens/historico/primeirasede5bprv.jpg') }}" class="event-image" alt="Sede 5º BPRv">
                <h3 class="event-title">O Guardião das Rodovias</h3>
                <p class="event-description">
                    Fundado para proteger o Sudoeste Paulista, o 5º Batalhão de Polícia Rodoviária assume a sua missão em 2008. 
                    Com sede em Sorocaba, torna-se referência em segurança e auxílio aos motoristas.
                </p>
            </div>
            <div style="width: 45%;"></div>
        </div>

    </section>
    

    <!-- Slogan Final -->
    <section class="py-20 text-center">
        <h2 class="slogan-history" style="font-family: 'Barlow Condensed', sans-serif; font-size: 3rem; font-weight: 900;">
            5º BPRv — O GUARDIÃO DAS RODOVIAS DO SUDOESTE PAULISTA.
        </h2>
    </section>

    <!-- Modal Lightbox -->
    <div id="imageLightbox">
        <span class="lightbox-close">&times;</span>
        <img class="lightbox-content" id="lightboxImg">
    </div>

</main>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const lightbox = document.getElementById('imageLightbox');
        const lightboxImg = document.getElementById('lightboxImg');
        const closeBtn = document.querySelector('.lightbox-close');
        const clickableImages = document.querySelectorAll('.event-image, .hero-image-card img');

        // Abrir Lightbox
        clickableImages.forEach(img => {
            img.addEventListener('click', function() {
                lightboxImg.src = this.src;
                lightbox.classList.add('active');
                document.body.classList.add('lightbox-open');
            });
        });

        // Fechar no Botão
        closeBtn.addEventListener('click', closeLightbox);

        // Fechar no clique fora da imagem
        lightbox.addEventListener('click', function(e) {
            if (e.target === lightbox || e.target === closeBtn) {
                closeLightbox();
            }
        });

        // Fechar com tecla Esc
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && lightbox.classList.contains('active')) {
                closeLightbox();
            }
        });

        function closeLightbox() {
            lightbox.classList.remove('active');
            document.body.classList.remove('lightbox-open');
        }
    });
</script>
@endsection