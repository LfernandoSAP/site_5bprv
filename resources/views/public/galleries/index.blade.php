@extends('layouts.apple')

@section('title', 'Galerias do 5º BPRv')

@section('content')
    <section class="container py-5 my-5">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-3 mb-5 reveal active">
            <div>
                <h1 class="display-4 fw-bold mb-0" style="letter-spacing: -1.5px;">Galerias</h1>
                <p class="fs-5 text-muted mt-2">Registros visuais das operações e solenidades do nosso batalhão.</p>
            </div>
            <a href="{{ route('public.home') }}" class="btn btn-dark rounded-pill px-4 py-2 fw-semibold shadow-sm">
                Voltar à Home
            </a>
        </div>

        <div class="row g-4">
            @forelse ($galleries as $gallery)
                <div class="col-lg-4 reveal active">
                    <article class="card bento-card shadow-sm h-100 border-0">
                        <a href="{{ route('public.galleries.show', $gallery) }}" class="text-decoration-none text-dark h-100 d-flex flex-column">
                            <div class="bento-img-container" style="height: 280px;">
                                @if ($gallery->cover_image_path)
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($gallery->cover_image_path) }}" 
                                         class="w-100 h-100 object-fit-cover" alt="{{ $gallery->title }}">
                                @else
                                    <div class="w-100 h-100 bg-dark d-flex align-items-center justify-content-center">
                                        <img src="{{ asset('imagens/logos/logo_5rv.png') }}" class="w-25 opacity-25" alt="5º BPRv">
                                    </div>
                                @endif
                            </div>
                            <div class="card-body p-4">
                                <span class="text-uppercase fw-bold small mb-2 d-block" style="color: #86868b; letter-spacing: 1px;">
                                    {{ $gallery->photos_count }} {{ $gallery->photos_count == 1 ? 'Foto' : 'Fotos' }}
                                </span>
                                <h3 class="card-title fw-bold fs-4 mb-2" style="letter-spacing: -0.5px;">{{ $gallery->title }}</h3>
                                <p class="card-text text-muted small">{{ Str::limit($gallery->description, 100) }}</p>
                            </div>
                        </a>
                    </article>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="display-6 text-muted">Nenhuma galeria disponível no momento.</div>
                </div>
            @endforelse
        </div>

        @if ($galleries->hasPages())
            <div class="pt-5 mt-5 d-flex justify-content-center">
                {{ $galleries->links() }}
            </div>
        @endif
    </section>
@endsection
