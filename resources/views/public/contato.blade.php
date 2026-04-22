@extends('layouts.apple')

@section('title', 'Contato | 5º BPRv - Polícia Rodoviária')

@section('styles')
    <style>
        /* ── Variáveis de Design ── */
        :root {
            --contact-gold: #d5aa32;
            --contact-black: #1a1a1a;
            --contact-gray: #111111;
        }

        /* ── Título com Brilho Institucional ── */
        .title-shimmer {
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 900;
            text-transform: none !important;
            background: linear-gradient(to right, #ffffff 10%, #d5aa32 40%, #aaa 50%, #d5aa32 60%, #ffffff 90%);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: pmespWipe 6s linear infinite;
            letter-spacing: -0.02em;
        }

        @keyframes pmespWipe {
            0%   { background-position: 150% center; }
            100% { background-position: -150% center; }
        }

        /* ── Mixin: dark card base (compartilhado) ── */
        .dark-card {
            background: var(--contact-black);
            border-radius: 24px;
            color: white;
            position: relative;
            overflow: hidden;
            transition: all 0.35s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .dark-card::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: radial-gradient(circle at 80% 20%, rgba(213, 170, 50, 0.13), transparent 65%);
            pointer-events: none;
            transition: opacity 0.4s ease;
            opacity: 1;
        }

        .dark-card:hover {
            background-color: #272318;
            border-color: var(--contact-gold) !important;
            box-shadow:
                0 20px 50px rgba(0, 0, 0, 0.55),
                0 0 0 1px var(--contact-gold),
                0 0 28px rgba(213, 170, 50, 0.18);
            transform: translateY(-4px);
        }

        .dark-card:hover::before {
            opacity: 3.5;
        }

        /* ── Cards Administrativos (P1 a P5) ── */
        .sector-card {
            border-radius: 20px;
            padding: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.07);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        .sector-name {
            font-size: 0.8rem;
            font-weight: 800;
            color: var(--contact-gold);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
        }

        .sector-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 1rem;
        }

        .sector-link {
            color: rgba(255, 255, 255, 0.55);
            text-decoration: none;
            font-size: 0.95rem;
            display: block;
            transition: color 0.2s;
        }

        .sector-link:hover {
            color: var(--contact-gold);
        }

        /* ── Grade de Unidades Operacionais (As 4 Cias) ── */
        .unit-pill {
            border-radius: 24px;
            padding: 2.5rem;
            border: 1px solid rgba(255, 255, 255, 0.07);
        }

        /* ── Emergência 190 ── */
        .emergency-hero {
            background: var(--contact-black);
            border-radius: 30px;
            padding: 3rem;
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .emergency-hero::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: radial-gradient(circle at top right, rgba(213, 170, 50, 0.15), transparent 70%);
        }

        .emergency-number {
            font-size: 4.125rem;
            font-weight: 900;
            color: var(--contact-gold);
            line-height: 1;
            text-shadow: 0 0 30px rgba(213, 170, 50, 0.3);
        }

        .info-label {
            color: rgba(255, 255, 255, 0.45);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 700;
        }

        /* Sede card */
        .sede-card {
            border: 1px solid rgba(255, 255, 255, 0.07);
        }

        /* ── Slogan com brilho (Esquerda -> Direita) ── */
        .slogan-left-to-right {
            position: relative;
            text-align: center !important;
            width: 100%;
            display: block;
            letter-spacing: 2px;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: clamp(1.8rem, 3.5vw, 2.5rem);
            font-weight: 900;
            background: linear-gradient(90deg, #111110, #242218, #6b664c, #6e6320, #cfaf21);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.8));
            background-size: 300% auto;
            opacity: 0;
            transform: translateY(30px) scale(0.95);
            animation: entradaSlogan 1s ease-out forwards, brilhoSloganLR 5s linear infinite;
        }

        @keyframes entradaSlogan {
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        @keyframes brilhoSloganLR {
            0%   { background-position: 300% center; }
            100% { background-position: 0% center; }
        }
    </style>
@endsection

@section('content')
    <div class="py-20" style="background-color: #111111;">
        <div class="max-w-7xl mx-auto px-4">

            {{-- ── Cabeçalho ── --}}
            <div class="text-center mb-16">
                <h1 class="title-shimmer font-heading">Central de Atendimento</h1>
                <p class="font-serif mt-4 text-xl max-w-2xl mx-auto" style="font-weight: 500; color: rgba(255,255,255,0.6);">
                    Canais de comunicação direta com o <strong style="color:rgba(255,255,255,0.9);">5º BPRv</strong>.
                    Selecione o setor ou unidade desejada.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                {{-- ── 1. Sede Administrativa & Emergência (Top) ── --}}
                <div class="lg:col-span-8">
                    <div class="dark-card sede-card p-10 h-100 flex flex-col justify-between"
                        style="background-image: radial-gradient(circle at top right, rgba(213,170,50,0.13), transparent 70%), url('{{ asset('imagens/logos/asa_rodoviaria.png') }}'); background-size: auto, 28%; background-repeat: no-repeat, no-repeat; background-position: center, 93% 50%; background-color: #1a1a1a;">
                        <div style="padding-left: 1%;">
                            <h2 class="text-4xl font-bold mb-6" style="color:#ffffff;">Sede do 5º BPRv</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div>
                                    <p class="font-bold mb-1" style="color:rgba(255,255,255,0.45);">Endereço Oficial</p>
                                    <p class="text-lg" style="color:rgba(255,255,255,0.85);">
                                        Rua Antonio Aparecido Ferraz, nº 1455<br>
                                        Parque Santa Izabel, Sorocaba - SP<br>
                                        <span class="text-sm font-normal">CEP: 18052-280</span>
                                    </p>
                                </div>
                                <div>
                                    <p class="font-bold mb-1" style="color:rgba(255,255,255,0.45);">Contato Central</p>
                                    <p class="text-lg" style="color:rgba(255,255,255,0.85);">
                                        PABX: <strong style="color:#ffffff;">(15) 3333-3140</strong><br>
                                        <span class="text-sm">Atendimento: Seções administrativas das 08h às 18h e Emergência/Sala de Operações 24h</span>
                                    </p>
                                    <a href="mailto:5bprv@policiamilitar.sp.gov.br"
                                        style="color:var(--contact-gold);" class="font-bold hover:underline mt-2 inline-block">5bprv@policiamilitar.sp.gov.br</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-4">
                    <div class="dark-card emergency-hero h-full flex flex-col justify-center">
                        <h3 class="text-2xl font-bold mb-2">CANAL DIRETO COM O COMANDANTE</h3>
                        <div class="emergency-number mb-2">
                            <a href="https://qr.link/ngxqYo" target="_blank" rel="noopener noreferrer" style="color: inherit; text-decoration: none; transition: opacity 0.2s;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                                FALE COM O COMANDANTE DO 5º BPRv
                            </a>
                        </div>
                        <p class="text-sm mb-5" style="color: rgba(255,255,255,0.65);">
                            👆 Clique aqui ou escaneie com o seu celular o QrCode ao lado
                        </p>
                        <img
                            src="{{ asset('imagens/comandante.jpg') }}"
                            alt="Fale com o Comandante"
                            style="display: block; align-self: flex-start; width: 140px; height: auto; margin-left: 1cm; border-radius: 8px; border: 2px solid rgba(213,170,50,0.4);">
                    </div>
                </div>

                {{-- ── 2. Canais Setoriais (Assuntos Específicos) ── --}}
                <div class="lg:col-span-12 mt-12">
                    <p class="info-label" style="text-align: center; margin: 2rem auto; font-size: 1rem; color: var(--contact-gold) !important;">Administração e Assuntos Específicos</p>
                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4">

                        {{-- Pessoal --}}
                        <div class="dark-card sector-card">
                            <p class="sector-name">Pessoal (P-1)</p>
                            <h4 class="sector-title">Recursos Humanos</h4>
                            <a href="tel:01533333149" class="sector-link">📞 (15) 3333-3149</a>
                            <a href="mailto:5bprvp1@policiamilitar.sp.gov.br" class="sector-link text-xs mt-2">✉️ E-mail P1 - 5bprvp1@policiamilitar.sp.gov.br</a>
                        </div>

                        {{-- Operações --}}
                        <div class="dark-card sector-card">
                            <p class="sector-name">Operações (P-3)</p>
                            <h4 class="sector-title">Estatística e Planilha</h4>
                            <a href="tel:01533333185" class="sector-link">📞 (15) 3333-3185</a>
                            <a href="mailto:5bprvp3@policiamilitar.sp.gov.br" class="sector-link text-xs mt-2">✉️ E-mail
                                P3 - 5bprvp3@policiamilitar.sp.gov.br</a>
                        </div>

                        {{-- Logística --}}
                        <div class="dark-card sector-card">
                            <p class="sector-name">Logística (P-4)</p>
                            <h4 class="sector-title">Suprimentos e Frota</h4>
                            <a href="tel:01533333170" class="sector-link">📞 (15) 3333-3170</a>
                            <a href="mailto:5bprvp4@policiamilitar.sp.gov.br" class="sector-link text-xs mt-2">✉️ E-mail P4 - 5bprvp4@policiamilitar.sp.gov.br</a>
                        </div>

                        {{-- P-5 --}}
                        <div class="dark-card sector-card">
                            <p class="sector-name">Imprensa (P-5)</p>
                            <h4 class="sector-title">Comunicação Social</h4>
                            <a href="tel:01533333154" class="sector-link">📞 (15) 3333-3154</a>
                            <a href="mailto:5bprvp5@policiamilitar.sp.gov.br" class="sector-link text-xs mt-2">✉️ E-mail P5 - 5bprvp5@policiamilitar.sp.gov.br</a>
                        </div>

                        {{-- Justiça --}}
                        <div class="dark-card sector-card">
                            <p class="sector-name">Justiça (SJD)</p>
                            <h4 class="sector-title">Protocolo Disciplinar</h4>
                            <a href="tel:01533333148" class="sector-link">📞 (15) 3333-3148</a>
                            <a href="mailto:5bprvp5@policiamilitar.sp.gov.br" class="sector-link text-xs mt-2">✉️ E-mail  - 5bprvprotocolo@policiamilitar.sp.gov.br</a>
                        </div>

                        {{-- Gabinete --}}
                        <div class="dark-card sector-card">
                            <p class="sector-name">Treinamento (GT)</p>
                            <h4 class="sector-title">Gabinete Instrução</h4>
                            <a href="tel:01533333183" class="sector-link">📞 (15) 3333-3183</a>
                            <a href="mailto:5bprvp5@policiamilitar.sp.gov.br" class="sector-link text-xs mt-2">✉️ E-mail GT - 5bprvgt@policiamilitar.sp.gov.br</a>
                        </div>

                    </div>
                </div>

                {{-- ── 3. Unidades Territoriais (As Companhias) ── --}}
                <div class="lg:col-span-12 mt-20">
                    <p class="info-label" style="text-align: center; margin: 2rem auto; font-size: 1rem; color: var(--contact-gold) !important;">Unidades Operacionais</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

                        {{-- 1ª Cia --}}
                        <div class="dark-card unit-pill">
                            <p class="sector-name mb-2">1ª CIA - SEDE</p>
                            <h4 class="text-xl font-bold mb-4" style="color:#ffffff;">Sorocaba</h4>
                            <p class="text-sm mb-6" style="color:rgba(255,255,255,0.5);">Policiamento na Região Metropolitana e Raposo Tavares.</p>
                            <a href="tel:1532211609"
                                class="font-bold text-lg transition-colors" style="color:#ffffff;">📞 (15) 3221-1609</a>
                        </div>

                        {{-- 2ª Cia --}}
                        <div class="dark-card unit-pill">
                            <p class="sector-name mb-2">2ª CIA</p>
                            <h4 class="text-xl font-bold mb-4" style="color:#ffffff;">Itapetininga</h4>
                            <p class="text-sm mb-6" style="color:rgba(255,255,255,0.5);">Responsável pela região Sul-Sudoeste do Batalhão.</p>
                            <a href="tel:1532712945"
                                class="font-bold text-lg transition-colors" style="color:#ffffff;">📞 (15) 3271-2945</a>
                        </div>

                        {{-- 3ª Cia --}}
                        <div class="dark-card unit-pill">
                            <p class="sector-name mb-2">3ª CIA</p>
                            <h4 class="text-xl font-bold mb-4" style="color:#ffffff;">Tatuí</h4>
                            <p class="text-sm mb-6" style="color:rgba(255,255,255,0.5);">Atuação estratégica no eixo da Rod. Castello Branco.</p>
                            <a href="tel:1532513444"
                                class="font-bold text-lg transition-colors" style="color:#ffffff;">📞 (15) 3251-3444</a>
                        </div>

                        {{-- 4ª Cia --}}
                        <div class="dark-card unit-pill">
                            <p class="sector-name mb-2">4ª CIA</p>
                            <h4 class="text-xl font-bold mb-4" style="color:#ffffff;">Barueri</h4>
                            <p class="text-sm mb-6" style="color:rgba(255,255,255,0.5);">Policiamento no Sistema Oeste da Castello Branco.</p>
                            <a href="tel:1120780410"
                                class="font-bold text-lg transition-colors" style="color:#ffffff;">📞 (11) 2078-0410</a>
                        </div>

                    </div>
                </div>

                {{-- ── Formulário (Design Final) ── --}}
                <div class="lg:col-span-12 mt-20 mb-20 text-center">
                    <div class="dark-card p-20 inline-block w-full text-center" style="border: 1px solid rgba(255,255,255,0.07);">
                        <h3 class="slogan-left-to-right mt-4 mb-4">5º BPRv — O GUARDIÃO DAS RODOVIAS DO SUDOESTE PAULISTA.</h3>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection