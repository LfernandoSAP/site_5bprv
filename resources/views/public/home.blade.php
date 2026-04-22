@extends('layouts.apple')

@section('title', 'Início | 5º BPRv - Polícia Rodoviária')

@section('styles')
<style>
    .font-heading { font-family: 'Barlow Condensed', sans-serif; }
    .font-body    { font-family: 'Source Sans 3', sans-serif; }

    .multi-item-card {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.10);
        transition: transform 0.3s ease;
        background: #ffffff;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .multi-item-card:hover { transform: translateY(-3px); }

    .multi-item-img {
        width: 100%;
        height: 380px;
        object-fit: cover;
        display: block;
        border-radius: 10px 10px 0 0;
    }

    .multi-item-caption {
        width: 100%;
        padding: 10px 15px !important;
        background: linear-gradient(to bottom, #f0f0f0, #c0c0c0);
        text-align: center;
        border-top: 1px solid #d0d0d0;
        border-radius: 0 0 10px 10px;
        flex-grow: 1;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .multi-item-caption h5 {
        color: #333333;
        font-family: 'Source Sans 3', sans-serif;
        font-size: 0.95rem;
        font-weight: 700;
        margin: 0;
        letter-spacing: 0.3px;
    }

    .bento-slide { display: none; }
    .bento-slide.active { display: block; }

    .carousel-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
        width: 100%;
    }
    @media (max-width: 767px) {
        .carousel-grid { grid-template-columns: 1fr; }
        .multi-item-img { height: 240px; }
    }
    @media (min-width: 768px) and (max-width: 1023px) {
        .carousel-grid { grid-template-columns: repeat(2, 1fr); }
    }

    .bento-dots { display: flex; justify-content: center; gap: 8px; margin-top: 16px; }
    .bento-dot {
        width: 10px; height: 10px;
        border-radius: 50%;
        background: #ccc;
        border: none;
        cursor: pointer;
        transition: background 0.3s, transform 0.2s;
        padding: 0;
    }
    .bento-dot.active { background: #d5aa32; transform: scale(1.3); }

    .slogan-absurdo {
        position: relative;
        text-align: center !important;
        width: 100%;
        display: block;
        letter-spacing: 2px;
        font-family: 'Barlow Condensed', sans-serif;
        font-size: clamp(1.6rem, 3.5vw, 3rem);
        font-weight: 900;
        background: linear-gradient(90deg, #111110, #242218, #6b664c, #6e6320, #cfaf21);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        filter: drop-shadow(0 2px 4px rgba(0,0,0,0.8));
        background-size: 300% auto;
        opacity: 0;
        transform: translateY(30px) scale(0.95);
        animation: entradaBPRv 1s ease-out forwards, brilhoBPRv 5s linear infinite;
    }
    @keyframes entradaBPRv {
        to { opacity: 1; transform: translateY(0) scale(1); }
    }
    @keyframes brilhoBPRv {
        0%   { background-position: 0% center; }
        100% { background-position: 300% center; }
    }
    .slogan-bprv::before {
        content: "";
        position: absolute; top: 0; left: -100%;
        width: 60%; height: 100%;
        background: linear-gradient(120deg, transparent, rgba(255,255,255,0.55), transparent);
        animation: luzViatura 3.5s infinite;
    }
    @keyframes luzViatura {
        0%   { left: -100%; }
        100% { left: 150%; }
    }
    .slogan-bprv::after {
        content: "";
        display: block;
        margin: 10px auto 0;
        width: 120px; height: 3px;
        background: linear-gradient(90deg, transparent, #ffd700, transparent);
        animation: linhaOficial 3s ease-in-out infinite;
    }
    @keyframes linhaOficial {
        0%   { width: 80px;  opacity: 0.4; }
        50%  { width: 160px; opacity: 1;   }
        100% { width: 80px;  opacity: 0.4; }
    }

    /* ─── Rodovia: canvas ocupa 100% do pai ─── */
    #rodoviaCanvas {
        display: block;
        width: 100%;
        height: 90px; /* altura real do canvas dentro do padding */
    }

    /* ─── Separador rodovia: Esticado até as bordas da tela ─── */
    .rodovia-wrapper {
        width: 100vw;
        position: relative;
        left: 50%;
        right: 50%;
        margin-left: -50vw;
        margin-right: -50vw;
        margin-top: 10px;
        margin-bottom: 20px;
        background: #383838;
        border-radius: 0;
        padding: 10px 0;
        box-sizing: border-box;
        overflow: hidden;
    }

    /* ─── Cards estáticos: força margem superior ─── */
    .cards-estaticos {
        margin-top: 0; /* já garantido pelo mb do rodovia-wrapper */
    }
</style>
@endsection

@section('content')
<section id="news" class="w-full px-4 md:px-12 py-12 mt-4">

    {{-- ── Slogan Institucional Animado ── --}}
    <div class="flex items-center justify-center mb-12">
        <div class="text-center">
            <h2 class="slogan-absurdo">
                5º BPRv — O GUARDIÃO DAS RODOVIAS DO SUDOESTE PAULISTA.
            </h2>
        </div>
    </div>

    {{-- ── Bento Slider ── --}}
    <div id="bentoSlider" class="w-full overflow-hidden px-0 md:px-4">

        {{-- Slide 1 --}}
        <div class="bento-slide active">
            <div class="carousel-grid">
                <div class="multi-item-card">
                    <img src="{{ asset('imagens/home/aereo2.jpeg') }}" class="multi-item-img" alt="Sede 5º BPRv">
                    <div class="multi-item-caption"><h5>Sede 5º BPRv</h5></div>
                </div>
                <div class="multi-item-card">
                    <img src="{{ asset('imagens/home/5rv_fachada2.jpeg') }}" class="multi-item-img" alt="Fachada">
                    <div class="multi-item-caption"><h5>Orgulho em pertencer</h5></div>
                </div>
                <div class="multi-item-card">
                    <img src="{{ asset('imagens/home/Motos01.jpg') }}" class="multi-item-img" alt="Motos">
                    <div class="multi-item-caption"><h5>Tradição</h5></div>
                </div>
            </div>
        </div>

        {{-- Slide 2 --}}
        <div class="bento-slide">
            <div class="carousel-grid">
                <div class="multi-item-card">
                    <img src="{{ asset('imagens/home/Moto_basehistorica1.jpg') }}" class="multi-item-img" alt="Base Histórica">
                    <div class="multi-item-caption"><h5>Preservação</h5></div>
                </div>
                <div class="multi-item-card">
                    <img src="{{ asset('imagens/home/moto_botelho.jpg') }}" class="multi-item-img" alt="Moto">
                    <div class="multi-item-caption"><h5>Profissionalismo</h5></div>
                </div>
                <div class="multi-item-card">
                    <img src="{{ asset('imagens/home/tor1.jpeg') }}" class="multi-item-img" alt="TOR">
                    <div class="multi-item-caption"><h5>Especializada TOR</h5></div>
                </div>
            </div>
        </div>

        {{-- Slide 3 --}}
        <div class="bento-slide">
            <div class="carousel-grid">
                <div class="multi-item-card">
                    <img src="{{ asset('imagens/home/91251f7a-335b-4fd8-83cb-ffb39e6c4833-1024x461.jpg') }}" class="multi-item-img" alt="Legado">
                    <div class="multi-item-caption"><h5>Legado</h5></div>
                </div>
                <div class="multi-item-card">
                    <img src="{{ asset('imagens/home/20211130_083808-1038x584.jpg') }}" class="multi-item-img" alt="Honra">
                    <div class="multi-item-caption"><h5>Honra</h5></div>
                </div>
                <div class="multi-item-card">
                    <img src="{{ asset('imagens/home/fachadaAereo.jpeg') }}" class="multi-item-img" alt="Excelência">
                    <div class="multi-item-caption"><h5>Excelência</h5></div>
                </div>
            </div>
        </div>

        {{-- Slide 4 --}}
        <div class="bento-slide">
            <div class="carousel-grid">
                <div class="multi-item-card">
                    <img src="{{ asset('imagens/home/alik.JPG') }}" class="multi-item-img" alt="Profissionalismo">
                    <div class="multi-item-caption"><h5>Profissionalismo</h5></div>
                </div>
                <div class="multi-item-card">
                    <img src="{{ asset('imagens/home/camila.JPG') }}" class="multi-item-img" alt="Resiliência">
                    <div class="multi-item-caption"><h5>Resiliência</h5></div>
                </div>
                <div class="multi-item-card">
                    <img src="{{ asset('imagens/home/TOR.jpg') }}" class="multi-item-img" alt="Excelência">
                    <div class="multi-item-caption"><h5>Excelência</h5></div>
                </div>
            </div>
        </div>

        {{-- Indicadores (bolinhas) --}}
        <div class="bento-dots" id="bentoDots">
            <button class="bento-dot active" data-index="0" aria-label="Slide 1"></button>
            <button class="bento-dot" data-index="1" aria-label="Slide 2"></button>
            <button class="bento-dot" data-index="2" aria-label="Slide 3"></button>
            <button class="bento-dot" data-index="3" aria-label="Slide 4"></button>
        </div>
    </div>

    {{-- ══ SEPARADOR: Rodovia Animada ══ --}}
    <div class="rodovia-wrapper">
        <canvas id="rodoviaCanvas"></canvas>
    </div>

    {{-- ── Três Cards Estáticos ── --}}
    <div class="carousel-grid cards-estaticos">
        <div class="multi-item-card">
            <img src="{{ asset('imagens/home/qualidade2026.jpeg') }}" class="multi-item-img" alt="Qualidade">
            <div class="multi-item-caption"><h5>Compromisso com a Qualidade</h5></div>
        </div>
        <div class="multi-item-card">
            <img src="{{ asset('imagens/home/salaoperacoes1.jpeg') }}" class="multi-item-img" alt="Operações">
            <div class="multi-item-caption"><h5>Tecnologia e Operações</h5></div>
        </div>
        <div class="multi-item-card">
            <img src="{{ asset('imagens/home/heliponto.jpeg') }}" class="multi-item-img" alt="Infraestrutura">
            <div class="multi-item-caption"><h5>Infraestrutura de Ponta</h5></div>
        </div>
    </div>

    {{-- ── Rodapé da seção ── --}}
    <div class="text-center mt-12">
        <h3 class="font-heading text-xl font-semibold text-[#202020] mb-1">@quintobprvpmesp</h3>
        <p class="text-[#6e6e6e] text-sm">Acompanhe nossas ações, operações e novidades nas redes sociais.</p>
    </div>

</section>
@endsection

@php
    $viaturaPath   = public_path('imagens/viatura_tor.png');
    $viaturaBase64 = file_exists($viaturaPath)
        ? 'data:image/png;base64,' . base64_encode(file_get_contents($viaturaPath))
        : '';
@endphp

@section('scripts')
<script>
// ── Bento Slider ──
(function () {
    const slides = document.querySelectorAll('.bento-slide');
    const dots   = document.querySelectorAll('.bento-dot');
    let current  = 0;
    let timer    = null;

    function goTo(index) {
        slides[current].classList.remove('active');
        dots[current].classList.remove('active');
        current = (index + slides.length) % slides.length;
        slides[current].classList.add('active');
        dots[current].classList.add('active');
    }

    function startAutoplay() { timer = setInterval(() => goTo(current + 1), 3000); }
    function stopAutoplay()  { clearInterval(timer); }

    dots.forEach(dot => {
        dot.addEventListener('click', () => {
            stopAutoplay();
            goTo(parseInt(dot.dataset.index));
            startAutoplay();
        });
    });

    const slider = document.getElementById('bentoSlider');
    slider.addEventListener('mouseenter', stopAutoplay);
    slider.addEventListener('mouseleave', startAutoplay);

    startAutoplay();
})();

// ── Rodovia Animada ──
(function () {
    const canvas = document.getElementById('rodoviaCanvas');
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    let width, height, lines = [], viaturaPos = -300;

    const viaturaImg = new Image();
    @if($viaturaBase64)
        viaturaImg.src = "{{ $viaturaBase64 }}";
    @else
        console.warn('viatura_tor.png não encontrada em public/imagens/');
    @endif

    function initCanvas() {
        // Agora ocupa 100% da largura da tela (Full Width)
        width  = canvas.width  = canvas.parentElement.offsetWidth;
        height = canvas.height = 90; 
        lines  = [];
        for (let i = 0; i < 20; i++) {
            lines.push({
                x:      Math.random() * width,
                y:      Math.random() * height,
                length: Math.random() * 80 + 20
            });
        }
    }

    function animate() {
        ctx.clearRect(0, 0, width, height);

        // Acostamento
        ctx.fillStyle = '#a6a6a6';
        ctx.fillRect(0, 0, width, 20);
        ctx.fillRect(0, height - 20, width, 20);

        // Asfalto
        ctx.fillStyle = '#383838';
        ctx.fillRect(0, 20, width, height - 40);

        // Faixas brancas laterais
        ctx.strokeStyle = '#ffffff';
        ctx.lineWidth = 2;
        ctx.beginPath(); ctx.moveTo(0, 24); ctx.lineTo(width, 24); ctx.stroke();
        ctx.beginPath(); ctx.moveTo(0, height - 24); ctx.lineTo(width, height - 24); ctx.stroke();

        // Faixa central dourada tracejada
        ctx.strokeStyle = '#d5aa32';
        ctx.setLineDash([50, 40]);
        ctx.lineWidth = 3;
        ctx.beginPath(); ctx.moveTo(0, height / 2); ctx.lineTo(width, height / 2); ctx.stroke();
        ctx.setLineDash([]);

        // Textura do asfalto
        ctx.strokeStyle = 'rgba(213, 170, 50, 0.12)';
        ctx.lineWidth = 1;
        lines.forEach(l => {
            ctx.beginPath();
            ctx.moveTo(l.x, l.y);
            ctx.lineTo(l.x + l.length, l.y);
            ctx.stroke();
        });

        // Viatura
        viaturaPos += 3;
        if (viaturaPos > width + 300) viaturaPos = -300;

        if (viaturaImg.complete && viaturaImg.naturalWidth > 0) {
            ctx.drawImage(viaturaImg, viaturaPos, (height - 45) / 2, 110, 45);
        }

        // Giroflex
        const flash = Math.sin(Date.now() / 50) > 0;
        ctx.fillStyle = flash ? 'rgba(255,0,0,0.9)' : 'rgba(255,0,0,0.2)';
        ctx.beginPath();
        ctx.arc(viaturaPos + 46, (height - 45) / 2 + 2, 3, 0, Math.PI * 2);
        ctx.fill();

        ctx.fillStyle = flash ? 'rgba(0,100,255,0.2)' : 'rgba(0,100,255,0.9)';
        ctx.beginPath();
        ctx.arc(viaturaPos + 57, (height - 45) / 2 + 2, 3, 0, Math.PI * 2);
        ctx.fill();

        requestAnimationFrame(animate);
    }

    window.addEventListener('resize', initCanvas);
    initCanvas();
    animate();
})();
</script>
@endsection
