{{--
  Componente de Card para Posts/Notícias
  
  Uso:
  <x-card-post 
      title="Título da Notícia"
      excerpt="Resumo da notícia..."
      image="/imagens/foto.jpg"
      date="13/04/2026"
      href="/publicacoes/slug-da-noticia"
  />
--}}

@props([
    'title' => '',
    'excerpt' => '',
    'image' => null,
    'date' => null,
    'href' => '#',
    'category' => null,
])

<article class="publication-card group">
    <a href="{{ $href }}" class="block">
        @if($image)
            <div class="publication-cover" style="background-image: url('{{ $image }}'); background-size: cover; background-position: center;"></div>
        @else
            <div class="publication-cover"></div>
        @endif
        
        <div class="p-5">
            @if($category)
                <span class="text-xs uppercase tracking-wider text-[#d5aa32] font-semibold">{{ $category }}</span>
            @endif
            
            <h3 class="font-heading text-xl font-bold text-black mt-2 mb-3 group-hover:text-[#d5aa32] transition-colors">
                {{ $title }}
            </h3>
            
            @if($excerpt)
                <p class="text-[#6e6e6e] text-sm line-clamp-3 mb-4">
                    {{ $excerpt }}
                </p>
            @endif
            
            @if($date)
                <time class="text-xs text-[#6e6e6e]">{{ $date }}</time>
            @endif
        </div>
    </a>
</article>
