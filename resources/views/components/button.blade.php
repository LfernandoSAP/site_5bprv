{{--
  Componente de Botão
  
  Uso:
  <x-button>Texto</x-button>
  <x-button variant="outline">Outline</x-button>
  <x-button size="sm">Pequeno</x-button>
  <x-button href="/pagina">Link</x-button>
  <x-button type="submit">Enviar</x-button>
  
  Variantes: primary, outline, ghost, danger
  Tamanhos: sm, md, lg
--}}

@props([
    'variant' => 'primary', // primary, outline, ghost, danger
    'size' => 'md',         // sm, md, lg
    'href' => null,
    'type' => 'button',
])

@php
$classes = match($variant) {
    'primary' => 'inline-flex items-center justify-center px-5 py-2.5 bg-black text-white font-semibold rounded-lg hover:bg-gray-900 transition-colors',
    'outline' => 'inline-flex items-center justify-center px-5 py-2.5 border-2 border-black text-black font-semibold rounded-lg hover:bg-black hover:text-white transition-colors',
    'ghost' => 'inline-flex items-center justify-center px-4 py-2 text-black font-medium rounded-lg hover:bg-gray-100 transition-colors',
    'danger' => 'inline-flex items-center justify-center px-5 py-2.5 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition-colors',
    default => 'inline-flex items-center justify-center px-5 py-2.5 bg-black text-white font-semibold rounded-lg hover:bg-gray-900 transition-colors',
};

$size = match($size) {
    'sm' => 'text-sm px-3 py-1.5',
    'lg' => 'text-lg px-7 py-3',
    default => '',
};
@endphp

@if($href)
    <a href="{{ $href }}" class="{{ $classes }} {{ $size }} {{ $attributes->get('class') }}">
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" class="{{ $classes }} {{ $size }} {{ $attributes->get('class') }}">
        {{ $slot }}
    </button>
@endif
