@extends('layouts.apple')

@section('title', $page->title.' | 5º BPRv')

@section('styles')
<style>
    :root {
        --gold: #d5aa32;
        --black: #050505;
    }

    html body {
        background-color: var(--black) !important;
        background: var(--black) !important;
        color: #ffffff;
    }

    .page-hero {
        padding: 5rem 1rem 7rem;
        text-align: center;
        background: radial-gradient(circle at center, rgba(213,170,50,0.07), transparent 70%);
    }

    .page-title {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: clamp(2.5rem, 7vw, 5rem);
        font-weight: 900;
        letter-spacing: -2px;
        line-height: 0.95;
        color: #ffffff;
        margin: 0 0 1.5rem;
    }

    .page-excerpt {
        font-size: 1.15rem;
        color: #777;
        line-height: 1.75;
        border-left: 3px solid var(--gold);
        padding-left: 1.5rem;
        margin-bottom: 2.5rem;
        font-style: italic;
        text-align: left;
    }

    .page-body {
        font-family: 'Source Sans 3', sans-serif;
        font-size: 1.08rem;
        line-height: 1.85;
        color: #bbb;
        white-space: pre-line;
    }

    footer {
        background-color: var(--black) !important;
        border-top: 1px solid rgba(255,255,255,0.05) !important;
        color: #555 !important;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .animate-in { animation: fadeInUp 0.7s ease-out; }
</style>
@endsection

@section('content')
<main>

    <div class="page-hero">
        <span style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 6px;
                     color: var(--gold); margin-bottom: 1rem; display: block;">
            Página Institucional
        </span>
        <h1 class="page-title">{{ strtoupper($page->title) }}</h1>
        @if($page->published_at)
            <p style="color: #444; font-size: 0.8rem; text-transform: uppercase;
                      letter-spacing: 2px; font-weight: 700;">
                Atualizado em {{ $page->published_at->translatedFormat('d \d\e F \d\e Y') }}
            </p>
        @endif
    </div>

    <div class="max-w-4xl mx-auto px-4 pb-16 animate-in" style="margin-top: -3rem;">

        <a href="{{ route('public.home') }}"
           style="color: var(--gold); font-size: 0.75rem; text-transform: uppercase;
                  letter-spacing: 2px; font-weight: 700; text-decoration: none;
                  display: inline-flex; align-items: center; gap: 6px; margin-bottom: 3rem;">
            ← Voltar ao Início
        </a>

        <div style="height: 1px; background: linear-gradient(to right, var(--gold), transparent); margin-bottom: 3rem;"></div>

        @if($page->excerpt)
            <p class="page-excerpt">{{ $page->excerpt }}</p>
        @endif

        <div class="page-body">{{ $page->content }}</div>

        <div style="height: 1px; background: rgba(255,255,255,0.05); margin: 4rem 0 0;"></div>

    </div>

</main>
@endsection
