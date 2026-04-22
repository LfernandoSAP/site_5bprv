@extends('layouts.apple')

@section('title', $gallery->title.' | 5º BPRv')

@section('content')
    <section class="container py-5 my-5">
        <div class="mb-5 reveal active">
            <a href="{{ route('public.galleries.index') }}" class="btn btn-outline-dark rounded-pill px-4 fw-semibold shadow-sm">
                ← Voltar às Galerias
            </a>
        </div>

        <article class="reveal active">
            <header class="mb-5">
                <div class="small text-uppercase fw-bold mb-3" style="color: #86868b; letter-spacing: 1.5px;">
                    Galeria Institucional &bull; {{ $gallery->photos_count }} {{ $gallery->photos_count == 1 ? 'Imagem' : 'Imagens' }}
                </div>
                <h1 class="display-3 fw-bold mb-4" style="letter-spacing: -2px; line-height: 1.1;">{{ $gallery->title }}</h1>
                @if ($gallery->description)
                    <p class="fs-4 text-muted col-lg-8 ps-0" style="line-height: 1.6;">{{ $gallery->description }}</p>
                @endif
            </header>

            <div class="row g-4 reveal active">
                @forelse ($gallery->photos as $photo)
                    <div class="col-md-6 col-lg-4">
                        <div class="card bento-card border-0 h-100 shadow-sm overflow-hidden">
                            <div class="bento-img-container" style="height: 300px;">
                                <img src="{{ \Illuminate\Support\Facades\Storage::url($photo->file_path) }}" 
                                     class="w-100 h-100 object-fit-cover" 
                                     alt="{{ $photo->title ?: 'Foto institucional' }}"
                                     style="cursor: pointer;">
                            </div>
                            @if ($photo->title || $photo->caption)
                                <div class="card-body p-4">
                                    <h5 class="fw-bold fs-5 mb-2">{{ $photo->title ?: 'Registro' }}</h5>
                                    <p class="small text-muted mb-0">{{ $photo->caption }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="display-6 text-muted">Esta galeria ainda não possui fotos publicadas.</div>
                    </div>
                @endforelse
            </div>
        </article>
    </section>
@endsection
