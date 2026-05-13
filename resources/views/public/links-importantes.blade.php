@extends('layouts.apple')

@section('title', 'Links Importantes | 5º BPRv - Polícia Rodoviária')

@section('styles')
<style>
    :root {
        --links-gold: #d5aa32;
        --links-black: #1a1a1a;
        --links-gray: #111111;
    }

    html body {
        background-color: #0d0d0d !important;
        background: #0d0d0d !important;
        color: #ffffff;
    }

    /* ── Hero ── */
    .links-hero {
        background: linear-gradient(135deg, #0d0d0d 0%, #1a1a1a 50%, #0d0d0d 100%);
        padding: 80px 20px 60px;
        text-align: center;
        border-bottom: 1px solid rgba(213,170,50,0.2);
        position: relative;
        overflow: hidden;
    }

    .links-hero::before {
        content: "";
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: radial-gradient(ellipse at 50% 0%, rgba(213,170,50,0.12) 0%, transparent 65%);
        pointer-events: none;
    }

    .links-hero-title {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: clamp(2.5rem, 6vw, 4.5rem);
        font-weight: 900;
        letter-spacing: 2px;
        text-transform: uppercase;
        background: linear-gradient(to right, #ffffff 10%, #d5aa32 40%, #aaa 50%, #d5aa32 60%, #ffffff 90%);
        background-size: 200% auto;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: shimmer 6s linear infinite;
        margin-bottom: 1rem;
    }

    @keyframes shimmer {
        0%   { background-position: 150% center; }
        100% { background-position: -150% center; }
    }

    .links-hero-sub {
        color: #a1a1a6;
        font-size: 1.05rem;
        letter-spacing: 1px;
    }

    /* ── Grid Principal ── */
    .links-section {
        max-width: 1200px;
        margin: 60px auto;
        padding: 0 20px;
    }

    .links-category-title {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 1.4rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 3px;
        color: var(--links-gold);
        border-left: 4px solid var(--links-gold);
        padding-left: 16px;
        margin-bottom: 24px;
        margin-top: 48px;
    }

    .links-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
    }

    /* ── Card de Link ── */
    .link-card {
        background: #1a1a1a;
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 18px;
        padding: 28px 24px;
        text-decoration: none;
        color: #ffffff;
        display: flex;
        align-items: flex-start;
        gap: 18px;
        transition: all 0.35s cubic-bezier(0.165, 0.84, 0.44, 1);
        position: relative;
        overflow: hidden;
    }

    .link-card::before {
        content: "";
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: radial-gradient(circle at 80% 20%, rgba(213,170,50,0.10), transparent 65%);
        pointer-events: none;
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .link-card:hover {
        background: #272318;
        border-color: var(--links-gold);
        box-shadow: 0 20px 50px rgba(0,0,0,0.55), 0 0 0 1px var(--links-gold), 0 0 28px rgba(213,170,50,0.15);
        transform: translateY(-4px);
        color: #ffffff;
        text-decoration: none;
    }

    .link-card:hover::before { opacity: 1; }

    .link-icon {
        font-size: 2rem;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .link-info-title {
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 4px;
        color: #fff;
    }

    .link-info-desc {
        font-size: 0.82rem;
        color: #a1a1a6;
        line-height: 1.4;
    }

    .link-arrow {
        margin-left: auto;
        color: var(--links-gold);
        font-size: 1.2rem;
        opacity: 0;
        transition: opacity 0.3s, transform 0.3s;
        flex-shrink: 0;
        align-self: center;
    }

    .link-card:hover .link-arrow {
        opacity: 1;
        transform: translateX(4px);
    }

    /* ── Divider ── */
    .gold-divider {
        height: 1px;
        background: linear-gradient(to right, transparent, rgba(213,170,50,0.4), transparent);
        margin: 60px 0 0;
    }

    /* ── DEJEM Card ── */
    .dejem-wrapper { }

    .dejem-card {
        background: #1a1a1a;
        border: 1px solid rgba(213,170,50,0.35);
        border-radius: 18px;
        padding: 28px 24px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 18px;
        transition: all 0.35s cubic-bezier(0.165, 0.84, 0.44, 1);
        position: relative;
        overflow: hidden;
        user-select: none;
    }

    .dejem-card::before {
        content: "";
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: radial-gradient(circle at 80% 20%, rgba(213,170,50,0.13), transparent 65%);
        pointer-events: none;
    }

    .dejem-card:hover, .dejem-card.open {
        background: #272318;
        border-color: var(--links-gold);
        box-shadow: 0 20px 50px rgba(0,0,0,0.55), 0 0 0 1px var(--links-gold), 0 0 28px rgba(213,170,50,0.15);
        transform: translateY(-2px);
    }

    .dejem-chevron {
        margin-left: auto;
        color: var(--links-gold);
        font-size: 1rem;
        transition: transform 0.3s ease;
        flex-shrink: 0;
    }

    .dejem-card.open .dejem-chevron { transform: rotate(180deg); }

    .dejem-subcard {
        display: none;
        background: #141414;
        border: 1px solid rgba(213,170,50,0.25);
        border-top: none;
        border-radius: 0 0 18px 18px;
        padding: 24px;
        margin-top: -4px;
    }

    .dejem-subcard.open { display: block; }

    .dejem-label {
        font-size: 0.82rem;
        color: #a1a1a6;
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .dejem-input-row {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .dejem-input {
        flex: 1;
        background: #0d0d0d;
        border: 1px solid rgba(255,255,255,0.12);
        border-radius: 10px;
        padding: 12px 16px;
        color: #fff;
        font-size: 1rem;
        outline: none;
        transition: border-color 0.3s;
    }

    .dejem-input:focus { border-color: var(--links-gold); }
    .dejem-input::placeholder { color: #555; }

    .dejem-btn {
        background: var(--links-gold);
        color: #000;
        font-weight: 700;
        border: none;
        border-radius: 10px;
        padding: 12px 22px;
        cursor: pointer;
        font-size: 0.9rem;
        letter-spacing: 0.5px;
        transition: background 0.2s, transform 0.2s;
        white-space: nowrap;
    }

    .dejem-btn:hover { background: #f0cc50; transform: scale(1.03); }

    /* ── Responsive ── */
    @media (max-width: 768px) {
        .links-grid { grid-template-columns: 1fr; }
        .links-hero { padding: 60px 16px 40px; }
        .dejem-input-row { flex-direction: column; }
        .dejem-btn { width: 100%; }
    }
</style>
@endsection

@section('content')

<div style="background: #0d0d0d; min-height: 80vh;">

    {{-- ── Hero ── --}}
    <div class="links-hero">
        <h1 class="links-hero-title">Links Importantes</h1>
        <p class="links-hero-sub">Acesso rápido aos portais, sistemas e recursos institucionais</p>
    </div>

    {{-- ── Portais Institucionais ── --}}
    <div class="links-section">

        <h2 class="links-category-title">Portais Institucionais</h2>
        <div class="links-grid">

            {{-- DEJEM Card --}}
            <div class="dejem-wrapper">
                <div class="dejem-card" id="dejemCard" onclick="toggleDejem()">
                    <span class="link-icon">📅</span>
                    <div>
                        <div class="link-info-title">DEJEM</div>
                        <div class="link-info-desc">Consulta de escala — insira seu ID para acessar</div>
                    </div>
                    <span class="dejem-chevron">▼</span>
                </div>
                <div class="dejem-subcard" id="dejemSubcard">
                    <div class="dejem-label">Insira seu ID DEJEM para abrir a escala</div>
                    <div class="dejem-input-row">
                        <input type="text" id="dejemId" class="dejem-input"
                               placeholder="Insira seu ID DEJEM"
                               onkeydown="if(event.key==='Enter') abrirDejem()">
                        <button class="dejem-btn" onclick="abrirDejem()">Acessar →</button>
                    </div>
                </div>
            </div>

            <a href="https://sistemasadmin.intranet.policiamilitar.sp.gov.br/TELEMATICA_INTRANET/ConsultaEmail.aspx" target="_blank" class="link-card">
                <span class="link-icon">✉️</span>
                <div>
                    <div class="link-info-title">Consulta de e-mail</div>
                    <div class="link-info-desc">Consulta institucional de endereços de e-mail</div>
                </div>
                <span class="link-arrow">→</span>
            </a>

            <a href="http://ms.policiamilitar.sp.gov.br/login.aspx" target="_blank" class="link-card">
                <span class="link-icon">📆</span>
                <div>
                    <div class="link-info-title">Dejem / Delegada</div>
                    <div class="link-info-desc">Sistema de escala e delegação</div>
                </div>
                <span class="link-arrow">→</span>
            </a>

            <a href="https://minhaarea.sp.gov.br/plataformasp" target="_blank" class="link-card">
                <span class="link-icon">📁</span>
                <div>
                    <div class="link-info-title">SEI</div>
                    <div class="link-info-desc">Sistema Eletrônico de Informações</div>
                </div>
                <span class="link-arrow">→</span>
            </a>

            <a href="http://10.61.9.89/formularios-pm/" target="_blank" class="link-card">
                <span class="link-icon">📝</span>
                <div>
                    <div class="link-info-title">Formulários Diversos</div>
                    <div class="link-info-desc">Repositório de formulários da corporação</div>
                </div>
                <span class="link-arrow">→</span>
            </a>

            <a href="https://sgp-prod.intranet.policiamilitar.sp.gov.br/" target="_blank" class="link-card">
                <span class="link-icon">👤</span>
                <div>
                    <div class="link-info-title">Assentamento Individual</div>
                    <div class="link-info-desc">SGP — Sistema de Gestão de Pessoal</div>
                </div>
                <span class="link-arrow">→</span>
            </a>

            <a href="https://www.sou.sp.gov.br/sou.sp/tutoriais/servidores-ativos/recadastramento-digital" target="_blank" class="link-card">
                <span class="link-icon">🔄</span>
                <div>
                    <div class="link-info-title">Recadastramento Anual</div>
                    <div class="link-info-desc">Recadastramento digital de servidores ativos</div>
                </div>
                <span class="link-arrow">→</span>
            </a>

            <a href="http://www.intranet.ccb.policiamilitar.sp.gov.br/aplicacoes/sisbol_login/frmlogin_cpd/" target="_blank" class="link-card">
                <span class="link-icon">📊</span>
                <div>
                    <div class="link-info-title">SISBOL</div>
                    <div class="link-info-desc">Sistema de boletins da PMESP</div>
                </div>
                <span class="link-arrow">→</span>
            </a>

            <a href="http://prdwinet.ccb.policiamilitar.sp.gov.br/assinatura/play.aspx" target="_blank" class="link-card">
                <span class="link-icon">✍️</span>
                <div>
                    <div class="link-info-title">Assinatura de e-mail</div>
                    <div class="link-info-desc">Gerador de assinatura institucional</div>
                </div>
                <span class="link-arrow">→</span>
            </a>

            <a href="https://www.simsgmder.der.sp.gov.br/simsgmder/" target="_blank" class="link-card">
                <span class="link-icon">🛣️</span>
                <div>
                    <div class="link-info-title">SIM DER</div>
                    <div class="link-info-desc">Sistema de informações e monitoramento DER-SP</div>
                </div>
                <span class="link-arrow">→</span>
            </a>

            <a href="http://10.61.15.39/" target="_blank" class="link-card">
                <span class="link-icon">🔐</span>
                <div>
                    <div class="link-info-title">PPRI</div>
                    <div class="link-info-desc">Portal de acesso restrito interno</div>
                </div>
                <span class="link-arrow">→</span>
            </a>

            <a href="https://sistemasopr.intranet.policiamilitar.sp.gov.br/BOPMTC.Web/Login" target="_blank" class="link-card">
                <span class="link-icon">📋</span>
                <div>
                    <div class="link-info-title">BO Eletrônico</div>
                    <div class="link-info-desc">Boletim de ocorrência eletrônico</div>
                </div>
                <span class="link-arrow">→</span>
            </a>

            <a href="https://www.ciaf.policiamilitar.sp.gov.br/folhadepagamento/autenticacaosegura.aspx" target="_blank" class="link-card">
                <span class="link-icon">💰</span>
                <div>
                    <div class="link-info-title">Holerite PM</div>
                    <div class="link-info-desc">Consulta de folha de pagamento</div>
                </div>
                <span class="link-arrow">→</span>
            </a>

            <a href="https://ead.pmesp.org/login/index.php" target="_blank" class="link-card">
                <span class="link-icon">🎓</span>
                <div>
                    <div class="link-info-title">EAD Treinamentos</div>
                    <div class="link-info-desc">Plataforma de ensino a distância da PMESP</div>
                </div>
                <span class="link-arrow">→</span>
            </a>

            <a href="https://www.imprensaoficial.com.br/" target="_blank" class="link-card">
                <span class="link-icon">📰</span>
                <div>
                    <div class="link-info-title">Imprensa Oficial</div>
                    <div class="link-info-desc">Diário Oficial do Estado de São Paulo</div>
                </div>
                <span class="link-arrow">→</span>
            </a>

            <a href="https://sistemasopr.intranet.policiamilitar.sp.gov.br/PMESP.CopomOnline/Login/Login" target="_blank" class="link-card">
                <span class="link-icon">🚔</span>
                <div>
                    <div class="link-info-title">Copom Online</div>
                    <div class="link-info-desc">Centro de operações da polícia militar</div>
                </div>
                <span class="link-arrow">→</span>
            </a>

            <a href="http://sicoordop.intranet.policiamilitar.sp.gov.br/login/index.php" target="_blank" class="link-card">
                <span class="link-icon">🗂️</span>
                <div>
                    <div class="link-info-title">Sicoordop</div>
                    <div class="link-info-desc">Sistema de coordenação operacional</div>
                </div>
                <span class="link-arrow">→</span>
            </a>

            <a href="https://sistemasopr.intranet.policiamilitar.sp.gov.br/siopmweb/HSiopm.aspx" target="_blank" class="link-card">
                <span class="link-icon">🌐</span>
                <div>
                    <div class="link-info-title">SIOPM WEB</div>
                    <div class="link-info-desc">Sistema integrado de operações PM</div>
                </div>
                <span class="link-arrow">→</span>
            </a>

            <a href="http://sisbol.intranet.policiamilitar.sp.gov.br/_sisbolsc8/grid_consulta_bol_int/" target="_blank" class="link-card">
                <span class="link-icon">📄</span>
                <div>
                    <div class="link-info-title">SISBOL — Consulta</div>
                    <div class="link-info-desc">Consulta de boletins internos</div>
                </div>
                <span class="link-arrow">→</span>
            </a>

        </div>

        <div class="gold-divider"></div>

        <div class="text-center" style="padding: 40px 0 20px; color: #555; font-size: 0.82rem;">
            Links externos abrem em nova aba.
        </div>

    </div>

</div>

@endsection

@section('scripts')
<script>
    function toggleDejem() {
        const card    = document.getElementById('dejemCard');
        const subcard = document.getElementById('dejemSubcard');
        const isOpen  = subcard.classList.contains('open');
        card.classList.toggle('open', !isOpen);
        subcard.classList.toggle('open', !isOpen);
        if (!isOpen) {
            setTimeout(() => document.getElementById('dejemId').focus(), 50);
        }
    }

    function abrirDejem() {
        const id = document.getElementById('dejemId').value.trim();
        if (!id) {
            document.getElementById('dejemId').focus();
            return;
        }
        const url = 'https://sistemasadmin.intranet.policiamilitar.sp.gov.br/Escala/arrelpreesc.aspx?' + id;
        window.open(url, '_blank');
    }
</script>
@endsection
