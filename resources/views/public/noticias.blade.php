@extends('layouts.apple')

@section('title', 'Notícias & Informe | 5º BPRv')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Barlow+Condensed:wght@400;700;900&display=swap" rel="stylesheet">
<style>
    /* ── Variáveis de Identidade ── */
    :root {
        --news-gold: #d5aa32;
        --news-black: #050505;
        --news-card: #111111;
        --news-border: rgba(213, 170, 50, 0.2);
    }

    html body {
        background-color: var(--news-black) !important;
        background: var(--news-black) !important;
        color: #ffffff;
    }

    /* ── Hero Notícias ── */
    .news-hero {
        height: 50vh;
        min-height: 400px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        overflow: hidden;
        background: radial-gradient(circle at center, rgba(213, 170, 50, 0.08), transparent 70%);
    }

    .hero-label {
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 6px;
        color: var(--news-gold);
        margin-bottom: 1.5rem;
        display: block;
        animation: fadeInDown 1s ease-out;
    }

    .hero-title {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: clamp(3rem, 8vw, 6rem);
        font-weight: 900;
        letter-spacing: -2px;
        line-height: 0.9;
        margin-bottom: 1rem;
        background: linear-gradient(to bottom, #ffffff 50%, #888888 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: fadeInUp 1s ease-out;
    }

    /* ── Destaques do Mês (Grid Especial) ── */
    .highlights-section {
        margin-top: -100px;
        position: relative;
        z-index: 10;
        padding-bottom: 5rem;
    }

    .destaque-card {
        background: var(--news-card);
        border: 1px solid var(--news-border);
        border-radius: 32px;
        padding: 3rem;
        height: 100%;
        position: relative;
        overflow: hidden;
        transition: all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
        box-shadow: 0 30px 60px rgba(0,0,0,0.5);
    }

    .destaque-card:hover {
        transform: translateY(-12px);
        border-color: var(--news-gold);
        box-shadow: 0 40px 80px rgba(213, 170, 50, 0.15);
    }

    .badge-gold {
        display: inline-block;
        padding: 6px 16px;
        background: linear-gradient(45deg, var(--news-gold), #fff7d1);
        color: #000;
        border-radius: 50px;
        font-weight: 900;
        font-size: 0.7rem;
        text-transform: uppercase;
        margin-bottom: 2rem;
    }

    .destaque-name {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 2.5rem;
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 1rem;
        color: #ffffff;
    }

    .destaque-meta {
        color: var(--news-gold);
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-size: 0.85rem;
        margin-bottom: 1.5rem;
        display: block;
    }

    .destaque-portrait {
        width: 100%;
        aspect-ratio: 4/5;
        background: linear-gradient(135deg, #1a1a1a 0%, #333 100%);
        border-radius: 20px;
        margin-bottom: 2rem;
        overflow: hidden;
        border: 1px solid rgba(255,255,255,0.05);
    }

    /* ── Mural de Eventos ── */
    .events-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 2.5rem;
        padding-bottom: 8rem;
    }

    .event-card {
        background: #111;
        border-radius: 24px;
        overflow: hidden;
        border: 1px solid rgba(255,255,255,0.03);
        transition: all 0.4s ease;
    }

    .event-card:hover {
        background: #161616;
        border-color: rgba(213, 170, 50, 0.3);
    }

    .event-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        opacity: 0.7;
        transition: opacity 0.4s;
    }

    .event-card:hover .event-image {
        opacity: 1;
    }

    .event-content {
        padding: 2rem;
    }

    .event-date {
        font-size: 0.75rem;
        color: var(--news-gold);
        font-weight: bold;
        margin-bottom: 1rem;
        display: block;
    }

    .event-title {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 1rem;
        line-height: 1.3;
    }

    .event-excerpt {
        color: #888;
        font-size: 0.95rem;
        line-height: 1.6;
    }

    /* ── Animations ── */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Override Footer para Dark */
    footer {
        background-color: #050505 !important;
        border-top: 1px solid rgba(255,255,255,0.05) !important;
    }
</style>
@endsection

@section('content')
<main>
    {{-- ── Hero Section ── --}}
    <section class="news-hero">
        <div class="px-4">
            <span class="hero-label">Notícias & Informe</span>
            <h1 class="hero-title">O DIA A DIA DO<br><span style="color: var(--news-gold); -webkit-text-fill-color: var(--news-gold);">5º BATALHÃO</span></h1>
            <p class="text-gray-500 font-serif italic text-lg max-w-2xl mx-auto mt-6">
                Eventos, conquistas e os destaques operacionais que mantêm o Sudoeste Paulista seguro.
            </p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4">
        
        {{-- ── Destaques do Mês ── --}}
        <section class="highlights-section">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                {{-- Policial do Mês --}}
                <div class="destaque-card">
                    <span class="badge-gold">Mérito Individual</span>
                    <span class="destaque-meta">Policial do Mês</span>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                        <div class="destaque-portrait">
                            <div class="w-full h-full bg-[radial-gradient(circle_at_center,_rgba(213,170,50,0.2),_transparent)] flex items-center justify-center">
                                <svg viewBox="0 0 448 512" style="width:40%; fill: var(--news-gold); opacity: 0.3;">
                                    <path d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="destaque-name">Cb PM Gonçalves</h3>
                            <p class="text-gray-400 font-serif italic mb-6">
                                "Reconhecimento pelo excepcional empenho e dedicação no desenvolvimento de novas ferramentas institucionais para o Batalhão."
                            </p>
                            <div class="w-12 h-1 bg-news-gold mb-4" style="background-color: var(--news-gold);"></div>
                            <span class="text-xs font-bold uppercase tracking-widest text-gray-500">Abril 2026</span>
                        </div>
                    </div>
                </div>

                {{-- Ocorrência Destaque --}}
                <div class="destaque-card" style="border-color: rgba(255,255,255,0.1);">
                    <span class="badge-gold" style="background: linear-gradient(45deg, #888, #fff);">Destaque Operacional</span>
                    <span class="destaque-meta" style="color: #fff;">Ocorrência do Mês</span>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                        <div class="destaque-portrait" style="background: url('{{ asset('imagens/home/tor1.jpeg') }}') center; background-size: cover;">
                            <div class="w-full h-full bg-black/40"></div>
                        </div>
                        <div>
                            <h3 class="destaque-name">Operação "Rota Segura"</h3>
                            <p class="text-gray-400 font-serif italic mb-6">
                                Apreensão recorde de ilícitos durante fiscalização tática na região de Itapetininga, garantindo a incolumidade das vias.
                            </p>
                            <div class="w-12 h-1 bg-white mb-4"></div>
                            <span class="text-xs font-bold uppercase tracking-widest text-gray-500">Março 2026</span>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        {{-- ── Mural de Eventos & Notícias ── --}}
        <section class="py-12">
            <div class="flex items-center gap-4 mb-12">
                <h2 class="text-3xl font-heading font-bold">EVENTOS & INFORMES</h2>
                <div class="flex-grow h-[1px] bg-white/10"></div>
            </div>

            <div class="events-grid">
                {{-- Evento 1 --}}
                <article class="event-card">
                    <img src="{{ asset('imagens/home/qualidade2026.jpeg') }}" class="event-image" alt="Qualidade">
                    <div class="event-content">
                        <span class="event-date">15 ABR 2026</span>
                        <h4 class="event-title">Certificação de Qualidade PMESP 2026</h4>
                        <p class="event-excerpt">5º BPRv inicia o ciclo de auditorias para manutenção do selo de excelência em gestão pública.</p>
                    </div>
                </article>

                {{-- Evento 2 --}}
                <article class="event-card">
                    <img src="{{ asset('imagens/home/saladeoperacoes.jpg') }}" class="event-image" alt="Operações">
                    <div class="event-content">
                        <span class="event-date">10 ABR 2026</span>
                        <h4 class="event-title">Nova Central de Monitoramento Integrado</h4>
                        <p class="event-excerpt">Tecnologia de ponta agora auxilia na vigilância das rodovias do sudoeste paulista em tempo real.</p>
                    </div>
                </article>

                {{-- Evento 3 --}}
                <article class="event-card">
                    <img src="{{ asset('imagens/home/motos3.jpg') }}" class="event-image" alt="Treinamento">
                    <div class="event-content">
                        <span class="event-date">02 ABR 2026</span>
                        <h4 class="event-title">Treinamento de Escolta e Batedor</h4>
                        <p class="event-excerpt">Efetivo de motociclistas passa por reciclagem tática para operações especiais de escolta.</p>
                    </div>
                </article>
            </div>
        </section>

    </div>
</main>
@endsection
