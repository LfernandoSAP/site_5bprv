@extends('layouts.apple')

@section('title', 'Redes Sociais | 5º BPRv')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@700;900&family=Playfair+Display:ital,wght@0,700;1,700&display=swap" rel="stylesheet">
<style>
    .font-heading { font-family: 'Barlow Condensed', sans-serif; }
    .font-serif { font-family: 'Playfair Display', serif; }

    .social-page-bg {
        background: #f5f5f7;
        min-height: 80vh;
    }

    /* ── Título com brilho dourado ── */
    .title-shimmer {
        font-size: clamp(2.5rem, 5vw, 4rem);
        font-weight: 900;
        background: linear-gradient(to right, #1a1a1a 20%, #d5aa32 40%, #888 50%, #d5aa32 60%, #1a1a1a 80%);
        background-size: 200% auto;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: pmespWipe 6s linear infinite;
    }
    @keyframes pmespWipe {
        0%   { background-position: 150% center; }
        100% { background-position: -150% center; }
    }

    /* ══════════════════════════════════════════
       CARD SOCIAL — Bandeira ocupa todo o fundo
    ══════════════════════════════════════════ */
    .social-card {
        position: relative;
        border-radius: 50px;       /* Bordas bem arredondadas como na foto */
        padding: 30px 40px;
        overflow: hidden;
        text-decoration: none !important;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        cursor: pointer;
        border: 1px solid rgba(213, 170, 50, 0.4); /* Borda dourada sutil */
        background: #ffffff;
        transition: transform 0.4s cubic-bezier(0.165, 0.84, 0.44, 1),
                    box-shadow 0.4s ease,
                    border-color 0.4s ease;
        width: 100%;               /* Ocupa a largura total */
        min-height: 180px;         /* Altura mais horizontal */
        justify-content: center;
        margin-bottom: 25px;       /* Espaçamento entre cards */
    }

    .social-card:hover {
        transform: scale(1.01);
        box-shadow: 0 15px 35px rgba(213, 170, 50, 0.15);
        border-color: #d5aa32;
    }

    /* ── Bandeira como fundo estático ── */
    .flag-bg {
        position: absolute;
        inset: 0;                   
        background-size: 100% 100%; /* Preenche o card todo de ponta a ponta */
        background-repeat: no-repeat;
        background-position: center;
        z-index: 0;
        opacity: 0.9;
    }

    /* ── Conteúdo posicionado à DIREITA ── */
    .card-content {
        position: relative;
        z-index: 2;
        display: flex;
        flex-direction: column;
        align-items: flex-end; /* Move para a direita */
        width: 100%;
        padding-right: 20px;   /* Reduzido para encostar mais à direita */
    }

    /* Textos com sombra e alinhados à direita */
    .social-name {
        color: #ffffff;
        font-size: 1.8rem;
        font-weight: 800;
        margin-bottom: 4px;
        text-shadow: 2px 2px 10px rgba(0,0,0,0.8);
        text-align: right;
    }

    .social-handle {
        font-size: 1.2rem;
        letter-spacing: 1px;
        font-weight: 900;
        text-align: right;
        background: linear-gradient(135deg, #fdf497 20%, #000000 100%); /* Amarelo Vibrante e Preto */
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        display: inline-block;
    }

    /* ── Ícone com Bordas Bonitas (Squircle) ── */
    .icon-box {
        width: 80px;
        height: 80px;
        border-radius: 28px;        /* Bordas bem mais arredondadas e elegantes */
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.3);
    }

    /* ── Textos com Efeito de Marca (Gradiente) ── */
    .social-name {
        font-size: 2.2rem;
        font-weight: 900;
        margin-bottom: 4px;
        text-align: right;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        display: inline-block;
    }

    /* ── Bandeiras específicas ── */
    .instagram-theme .flag-bg {
        background-image: url("{{ asset('public/imagens/bandeiras/bandeira_brasil.png') }}");
    }
    .facebook-theme .flag-bg {
        background-image: url("{{ asset('public/imagens/bandeiras/bandeira_sp.png') }}");
    }
    .youtube-theme .flag-bg {
        background-image: url("{{ asset('public/imagens/bandeiras/bandeira_sorocaba.png') }}");
    }

    /* ── Borda dourada sutil no hover específico ── */
    /* ── Instagram Theme ── */
    .instagram-theme .icon-box { 
        background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%); 
    }
    .instagram-theme .social-name {
        background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
        -webkit-background-clip: text;
    }

    /* ── Facebook Theme ── */
    .facebook-theme .icon-box { 
        background: #1877F2; 
    }
    .facebook-theme .social-name {
        background: #1877F2;
        -webkit-background-clip: text;
    }

    /* ── YouTube Theme ── */
    .youtube-theme .icon-box { 
        background: #ffffff; 
    }
    .youtube-theme .social-name {
        background: linear-gradient(135deg, #FF0000 0%, #D6249F 100%);
        -webkit-background-clip: text;
    }
</style>
@endsection

@section('content')
<div class="social-page-bg py-20">
    <div class="max-w-7xl mx-auto px-4">

        {{-- ── Cabeçalho ── --}}
        <div class="text-center mb-20">
            <h1 class="title-shimmer font-heading mb-4">Siga o 5º BPRv</h1>
            <p class="font-serif" style="color: #4a4a4a; font-size: 1.3rem; font-weight: 700; max-width: 700px; margin: 0 auto; line-height: 1.6;">
                Mantenha-se por dentro das nossas ações e da segurança viária nas
                <strong>principais plataformas digitais.</strong>
            </p>
        </div>

        {{-- ── Grid de Cards em Lista ── --}}
        <div style="display: flex; flex-direction: column; gap: 10px; max-width: 1000px; margin: 0 auto;">

            {{-- ── Instagram + Bandeira Brasil ── --}}
            <a href="https://www.instagram.com/quintobprvpmesp" target="_blank"
               class="social-card instagram-theme">
                <div class="flag-bg"></div>
                <div class="card-content">
                    <div class="icon-box">
                        <svg viewBox="0 0 448 512" style="width: 44px; height: 44px;">
                            <rect width="448" height="512" rx="100" fill="white" />
                            <defs>
                                <linearGradient id="instaGradient" x1="0%" y1="100%" x2="100%" y2="0%">
                                    <stop offset="0%" style="stop-color:#FFD600;stop-opacity:1" />
                                    <stop offset="25%" style="stop-color:#FF7A00;stop-opacity:1" />
                                    <stop offset="50%" style="stop-color:#FF0069;stop-opacity:1" />
                                    <stop offset="75%" style="stop-color:#D300C5;stop-opacity:1" />
                                    <stop offset="100%" style="stop-color:#7638FF;stop-opacity:1" />
                                </linearGradient>
                            </defs>
                            <path fill="url(#instaGradient)" d="M224.1 141c-45.8 0-82.8 37-82.8 82.8s37 82.8 82.8 82.8c45.8 0 82.8-37 82.8-82.8s-37-82.8-82.8-82.8zm0 136c-29.4 0-53.2-23.8-53.2-53.2s23.8-53.2 53.2-53.2 53.2 23.8 53.2 53.2-23.8 53.2-53.2 53.2zm135.6-136.4c-5.4-13.5-16.5-24.6-30-30-22.4-8.9-75.6-6.9-105.6-6.9s-83.1-2-105.6 6.9c-13.5 5.4-24.6 16.5-30 30-8.9 22.4-6.9 75.6-6.9 105.6s-2 83.1 6.9 105.6c5.4 13.5 16.5 24.6 30 30 22.4 8.9 75.6 6.9 105.6 6.9s83.1 2 105.6-6.9c13.5-5.4 24.6-16.5 30-30 8.9-22.4 6.9-75.6 6.9-105.6s2-83.1-6.9-105.6zM326.7 326.7c-9.1 9.1-21.6 14.5-35.3 14.5H156.6c-13.7 0-26.2-5.4-35.3-14.5-9.1-9.1-14.5-21.6-14.5-35.3V156.6c0-13.7 5.4-26.2 14.5-35.3s21.6-14.5 35.3-14.5h134.8c13.7 0 26.2 5.4 35.3 14.5s14.5 21.6 14.5 35.3v134.8c0 13.7-5.4 26.2-14.5 35.3z"/>
                        </svg>
                    </div>
                    <div class="social-name">Instagram</div>
                    <div class="social-handle">@quintobprvpmesp</div>
                </div>
            </a>

            {{-- ── Facebook + Bandeira SP ── --}}
            <a href="https://facebook.com/quintobprvpmespoficial" target="_blank"
               class="social-card facebook-theme">
                <div class="flag-bg"></div>
                <div class="card-content">
                    <div class="icon-box">
                        <svg viewBox="0 0 512 512" style="width: 44px; height: 44px;">
                            <rect width="512" height="512" rx="100" fill="white" />
                            <path fill="#1877F2" d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.8 90.7 226.4 209.3 245V327.7h-63V256h63v-54.6c0-62.2 37-96.6 93.7-96.6 27.2 0 55.5 4.8 55.5 4.8v61h-31.2c-30.8 0-40.5 19.1-40.5 38.6V256h68.8l-11 71.7h-57.8V501C413.3 482.4 504 379.8 504 256z"/>
                        </svg>
                    </div>
                    <div class="social-name">Facebook</div>
                    <div class="social-handle">Polícia Rodoviária</div>
                </div>
            </a>

            <!-- YouTube + Bandeira Sorocaba ── -->
            <a href="https://www.youtube.com/quintobprvpmesp" target="_blank"
               class="social-card youtube-theme">
                <div class="flag-bg"></div>
                <div class="card-content">
                    <div class="icon-box">
                        <svg viewBox="0 0 576 512" style="width: 54px; height: 54px;">
                            <rect width="576" height="512" rx="100" fill="white" />
                            <defs>
                                <linearGradient id="ytGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                    <stop offset="0%" style="stop-color:#FF0000;stop-opacity:1" />
                                    <stop offset="100%" style="stop-color:#CC0000;stop-opacity:1" />
                                </linearGradient>
                            </defs>
                            <path fill="url(#ytGradient)" d="M549.7 124.1c-6.3-23.7-24.8-42.3-48.3-48.6C458.8 64 288 64 288 64S117.2 64 74.6 75.5c-23.5 6.3-42 24.9-48.3 48.6-11.4 42.9-11.4 131.9-11.4 131.9s0 89-11.4 131.9c6.3 23.7 24.8 41.5 48.3 47.8C117.2 448 288 448 288 448s170.8 0 213.4-11.5c23.5-6.3 42-24.2 48.3-47.8 11.4-42.9 11.4-131.9 11.4-131.9s0-89-11.4-131.9zM232 337.7V174.3l142 81.7-142 81.7z"/>
                        </svg>
                    </div>
                    <div class="social-name">YouTube</div>
                    <div class="social-handle">Quinto BPRv PMESP</div>
                </div>
            </a>

        </div>

        {{-- ── Rodapé ── --}}
        <div style="margin-top: 80px; text-align: center; color: #6e6e6e; font-style: italic;">
            "Polícia Militar, a Força Pública de São Paulo."
        </div>

    </div>
</div>
@endsection