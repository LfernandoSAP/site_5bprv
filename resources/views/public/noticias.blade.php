@extends('layouts.apple')

@section('title', 'Notícias | 5º BPRv')

@section('styles')
<style>
    :root {
        --news-gold: #d5aa32;
        --news-black: #111111;
        --news-dark: #1a1a1a;
    }

    html body {
        background-color: var(--news-black) !important;
        background: var(--news-black) !important;
        color: #ffffff;
    }

    .news-hero {
        height: 40vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        background: radial-gradient(circle at center, rgba(213, 170, 50, 0.1), transparent 70%);
    }

    .news-grid {
        display: grid;
        grid-template-cols: repeat(auto-fill, minmax(350px, 1fr));
        gap: 30px;
        max-width: 1200px;
        margin: 0 auto 100px;
        padding: 0 20px;
    }

    .news-card {
        background: var(--news-dark);
        border-radius: 24px;
        overflow: hidden;
        border: 1px solid rgba(255,255,255,0.05);
        transition: all 0.4s ease;
        text-decoration: none;
        display: block;
    }

    .news-card:hover {
        transform: translateY(-10px);
        border-color: var(--news-gold);
        box-shadow: 0 20px 40px rgba(0,0,0,0.4);
    }

    .news-thumb {
        width: 100%;
        height: 240px;
        object-fit: cover;
        border-bottom: 1px solid rgba(255,255,255,0.05);
    }

    .news-info {
        padding: 25px;
    }

    .news-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #fff;
        margin-bottom: 8px;
    }

    .news-date {
        font-size: 0.75rem;
        color: var(--news-gold);
        text-transform: uppercase;
        letter-spacing: 1px;
    }
</style>
@endsection

@section('content')
<main>
    <section class="news-hero">
        <p class="text-sm uppercase tracking-[0.3em] text-[#d5aa32] mb-4">Atualizações e Informes</p>
        <h1 class="text-5xl font-bold font-heading">NOTÍCIAS</h1>
    </section>

    <section class="news-grid">
        <!-- Exemplo de Notícia 1 -->
        <a href="#" class="news-card">
            <img src="{{ asset('imagens/home/qualidade2026.jpeg') }}" class="news-thumb" alt="Qualidade">
            <div class="news-info">
                <span class="news-date">Abril 2026</span>
                <h3 class="news-title">Título Provisório: Modernização do 5º BPRv</h3>
            </div>
        </a>

        <!-- Exemplo de Notícia 2 -->
        <a href="#" class="news-card">
            <img src="{{ asset('imagens/home/tor1.jpeg') }}" class="news-thumb" alt="Treinamento TOR">
            <div class="news-info">
                <span class="news-date">Março 2026</span>
                <h3 class="news-title">Título Provisório: Treinamento TOR Efetuado com Sucesso</h3>
            </div>
        </a>

        <!-- Exemplo de Notícia 3 -->
        <a href="#" class="news-card">
            <img src="{{ asset('imagens/home/salaoperacoes1.jpeg') }}" class="news-thumb" alt="Tecnologia">
            <div class="news-info">
                <span class="news-date">Fevereiro 2026</span>
                <h3 class="news-title">Título Provisório: Nova Sala de Operações inaugura</h3>
            </div>
        </a>
    </section>

    <section class="py-20 text-center border-t border-white/5">
        <p class="text-gray-500 italic">Mais notícias serão adicionadas em breve.</p>
    </section>
</main>
@endsection
