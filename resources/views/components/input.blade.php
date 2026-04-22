{{--
  Componente de Input de Formulário
  
  Uso:
  <x-input name="titulo" label="Título" value="..." placeholder="Digite..." />
  <x-input name="email" type="email" label="Email" required error="Email inválido" />
  
  Atributos suportados: name, label, type, value, placeholder, required, error, help
--}}

@props([
    'name' => '',
    'label' => '',
    'type' => 'text',
    'value' => '',
    'placeholder' => '',
    'required' => false,
    'error' => null,
    'help' => null,
])

<div class="mb-4">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-[#202020] mb-1.5">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif
    
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        @if($required) required @endif
        class="w-full px-4 py-2.5 border rounded-lg transition-colors
            @if($error)
                border-red-300 bg-red-50 focus:border-red-500 focus:ring-2 focus:ring-red-200
            @else
                border-gray-300 focus:border-black focus:ring-2 focus:ring-gray-200
            @endif
            {{ $attributes->get('class') }}"
    />
    
    @if($error)
        <p class="mt-1.5 text-sm text-red-600">{{ $error }}</p>
    @endif
    
    @if($help && !$error)
        <p class="mt-1.5 text-sm text-gray-500">{{ $help }}</p>
    @endif
</div>
