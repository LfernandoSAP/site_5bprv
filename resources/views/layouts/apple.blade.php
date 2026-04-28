<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', '5º BPRv'))</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;600;700;900&family=Source+Sans+3:wght@400;600;700&display=swap" rel="stylesheet">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <!-- Fallback Manual para Intranet -->
    <link rel="stylesheet" href="{{ asset('public/build/assets/app-i-A-8aky.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/app-i-A-8aky.css') }}">

    <style>
        .nav-link-apple {
            color: #ffffff;
            font-size: 1.035rem;
            text-decoration: none;
            font-family: 'Barlow Condensed', sans-serif;
            font-weight: 600;
            letter-spacing: 0.5px;
            position: relative;
            padding-bottom: 4px;
            transition: color 0.3s ease;
        }
        .nav-link-apple::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0%;
            height: 2px;
            background: #d5aa32;
            border-radius: 2px;
            transition: width 0.3s ease;
        }
        .nav-link-apple:hover::after,
        .nav-link-apple.active::after {
            width: 100%;
        }
        .nav-link-apple.active {
            color: #d5aa32;
        }
        .header-logo-fixed {
            height: 70px;
            width: auto;
            object-fit: contain;
        }
        .title-institutional {
            color: #ffffff !important;
            transition: text-shadow 0.3s ease, transform 0.3s ease;
            cursor: default;
        }
        .title-institutional:hover {
            text-shadow: 0 0 15px rgba(213, 170, 50, 0.8), -1px -1px 0 #d5aa32, 1px -1px 0 #d5aa32, -1px 1px 0 #d5aa32, 1px 1px 0 #d5aa32 !important;
            transform: scale(1.01);
        }
        header {
            position: relative !important;
            flex-shrink: 0 !important;
        }
        header > div:first-child,
        header > div:last-child {
            position: absolute !important;
        }

        /* ── CHAVE MESTRA: Liberação da Grafia Institucional ── */
        h1, h2, h3, h4, 
        .font-heading, 
        .site-title, 
        .site-subtitle, 
        .hero-title, 
        .hero-label, 
        .section-label, 
        .nav-link-apple,
        .floating-pill__label, 
        .quick-link-card__eyebrow {
            text-transform: none !important;
        }

        /* Forçar Fundo Cinza em todo o site */
        body {
            background: #f5f5f7 !important;
        }
    </style>

    @yield('styles')
</head>
<body class="font-sans antialiased bg-white text-[#202020] m-0 p-0 overflow-x-hidden">

    <header style="
        position: relative;
        background-color: #222222;
        height: 160px;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        border-bottom: 1px solid rgba(255,255,255,0.05);
        flex-shrink: 0;
        box-sizing: border-box;">

        <div style="
            position: absolute;
            top: 50%;
            left: 20px;
            transform: translateY(-50%);
            display: flex;
            align-items: center;
            gap: 12px;
            z-index: 10;">
            <img src="{{ asset('imagens/logos/asa_rodoviaria.png') }}"
                 alt="Asa Rodoviária"
                 style="height: 70px; width: auto; object-fit: contain; display: block;">
            <img src="{{ asset('imagens/logos/logo-branca.png') }}"
                 alt="Logo Branca"
                 style="height: 70px; width: auto; object-fit: contain; display: block;">
        </div>

        <div style="text-align: center; z-index: 10; padding: 0 230px;">
            <h1 style="
                font-size: clamp(1.1rem, 2.5vw, 2.8rem);
                line-height: 1.2;
                text-shadow: -1px -1px 0 #9b9688, 1px -1px 0 #d5aa32, -1px 1px 0 #423f37, 1px 1px 0 #d5aa32;
                letter-spacing: 7px;
                color: #ffffff;
                font-family: 'Barlow Condensed', sans-serif;
                font-weight: 700;
                margin: 0;
                padding: 0;">
                5º Batalhão de Polícia Rodoviária
            </h1>
            <p style="
                font-size: 1.4rem;
                color: #ffffff;
                font-family: 'Source Sans 3', sans-serif;
                margin-top: 5px;
                margin-bottom: 0;
                text-shadow: -1px -1px 0 #555, 1px -1px 0 #555, -1px 1px 0 #555, 1px 1px 0 #555;">
                Polícia Militar do Estado de São Paulo
            </p>
        </div>

        <div style="
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
            display: flex;
            align-items: center;
            gap: 12px;
            z-index: 10;">
            <img src="{{ asset('imagens/logos/logo_5rv.png') }}"
                 alt="Logo 5º BPRv"
                 style="height: 70px; width: auto; object-fit: contain; display: block;">
            <img src="{{ asset('imagens/logos/logo_ouro.png') }}"
                 alt="Logo Ouro"
                 style="height: 70px; width: auto; object-fit: contain; display: block;">
        </div>

    </header>

    <nav class="sticky top-0 z-[9999] w-full border-b border-white/10" style="background-color: #111111 !important; height: 35px;">
        <div class="h-full w-full" style="display: flex !important; align-items: center !important; justify-content: space-between !important; padding: 0 20px !important;">

            <div style="width: 100px; display: flex; justify-content: flex-start;">
                <img src="{{ asset('imagens/logos/logo_coin2.png') }}" alt="Logo 5º BPRv" style="height: 25px; width: auto; opacity: 0.8;">
            </div>

            <ul style="display: flex !important; flex-direction: row !important; align-items: center !important; justify-content: center !important; list-style: none !important; margin: 0 !important; padding: 0 !important; gap: 22px !important; height: 100%;">
                <li><a class="nav-link-apple {{ !defined('MODO_HISTORICO') && !defined('MODO_REDES') && !defined('MODO_CONTATO') && !defined('MODO_MEMORIAL') && !defined('MODO_TOR') && !defined('MODO_GALERIAS') && !defined('MODO_NOTICIAS') && !request()->is('publicacoes*') ? 'active' : '' }}" href="{{ env('APP_URL') }}/" style="font-size: 1.035rem; line-height: 35px;">Início</a></li>
                <li><a class="nav-link-apple {{ defined('MODO_HISTORICO') ? 'active' : '' }}" href="{{ env('APP_URL') }}/historico.php" style="font-size: 1.035rem; line-height: 35px;">Histórico</a></li>
                <li><a class="nav-link-apple {{ defined('MODO_MEMORIAL') ? 'active' : '' }}" href="{{ env('APP_URL') }}/memorial.php" style="font-size: 1.035rem; line-height: 35px;">Memorial</a></li>
                <li><a class="nav-link-apple {{ defined('MODO_TOR') ? 'active' : '' }}" href="{{ env('APP_URL') }}/tor.php" style="font-size: 1.035rem; line-height: 35px;">TOR</a></li>
                <li><a class="nav-link-apple {{ defined('MODO_GALERIAS') ? 'active' : '' }}" href="{{ env('APP_URL') }}/galerias.php" style="font-size: 1.035rem; line-height: 35px;">Galeria</a></li>
                <li><a class="nav-link-apple {{ defined('MODO_REDES') ? 'active' : '' }}" href="{{ env('APP_URL') }}/redes-sociais.php" style="font-size: 1.035rem; line-height: 35px;">Redes Sociais</a></li>
                <li><a class="nav-link-apple {{ defined('MODO_NOTICIAS') || request()->is('publicacoes*') ? 'active' : '' }}" href="{{ env('APP_URL') }}/noticias.php" style="font-size: 1.035rem; line-height: 35px;">Notícias</a></li>
                <li><a class="nav-link-apple {{ defined('MODO_CONTATO') ? 'active' : '' }}" href="{{ env('APP_URL') }}/contato.php" style="font-size: 1.035rem; line-height: 35px;">Contato</a></li>
            </ul>

            <div style="width: 100px; display: flex; justify-content: flex-end;">
                <a href="{{ url('/admin') }}" class="text-white/40 hover:text-white transition-colors uppercase font-bold" style="font-size: 8px; border: 1px solid rgba(255,255,255,0.1); padding: 1px 6px; border-radius: 4px; letter-spacing: 1px;">Admin</a>
            </div>

        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="py-12 text-center mt-12 bg-[#f5f5f7] border-t border-[#d2d2d7] text-[#86868b]" style="background-color: #f5f5f7;">
        <div class="max-w-7xl mx-auto px-4">
            <p class="mb-2 text-sm">Este é o Portal Institucional Oficial do 5º Batalhão de Polícia Rodoviária.</p>
            <small class="block">&copy; {{ date('Y') }} Polícia Militar do Estado de São Paulo. Todos os direitos reservados - Desenvolvedor Cb PM F. Gonçalves (15) 99704-3077</small>
        </div>
    </footer>

    @yield('scripts')


</body>
</html>
