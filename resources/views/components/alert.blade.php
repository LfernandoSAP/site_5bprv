{{--
  Componente de Alerta/Mensagem
  
  Uso:
  <x-alert type="success">Operação realizada!</x-alert>
  <x-alert type="error" dismissible>Erro ao salvar.</x-alert>
  
  Tipos: success, error, warning, info
--}}

@props([
    'type' => 'info', // success, error, warning, info
])

@php
$config = match($type) {
    'success' => [
        'bg' => 'bg-green-50',
        'border' => 'border-green-200',
        'text' => 'text-green-800',
        'icon' => '✓',
    ],
    'error' => [
        'bg' => 'bg-red-50',
        'border' => 'border-red-200',
        'text' => 'text-red-800',
        'icon' => '✕',
    ],
    'warning' => [
        'bg' => 'bg-yellow-50',
        'border' => 'border-yellow-200',
        'text' => 'text-yellow-800',
        'icon' => '⚠',
    ],
    'info' => [
        'bg' => 'bg-blue-50',
        'border' => 'border-blue-200',
        'text' => 'text-blue-800',
        'icon' => 'ℹ',
    ],
    default => [
        'bg' => 'bg-gray-50',
        'border' => 'border-gray-200',
        'text' => 'text-gray-800',
        'icon' => 'ℹ',
    ],
};
@endphp

<div class="{{ $config['bg'] }} border {{ $config['border'] }} {{ $config['text'] }} px-4 py-3 rounded-lg {{ $attributes->get('class') }}" role="alert">
    <div class="flex items-center gap-3">
        <span class="text-lg">{{ $config['icon'] }}</span>
        <span>{{ $slot }}</span>
    </div>
</div>
