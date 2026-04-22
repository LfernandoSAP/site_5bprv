{{--
  Componente de Textarea
  
  Uso:
  <x-textarea name="conteudo" label="Conteúdo" rows="5" />
--}}

@props([
    'name' => '',
    'label' => '',
    'value' => '',
    'rows' => 4,
    'placeholder' => '',
    'required' => false,
    'error' => null,
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
    
    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        rows="{{ $rows }}"
        placeholder="{{ $placeholder }}"
        @if($required) required @endif
        class="w-full px-4 py-2.5 border rounded-lg transition-colors resize-y min-h-[100px]
            @if($error)
                border-red-300 bg-red-50 focus:border-red-500 focus:ring-2 focus:ring-red-200
            @else
                border-gray-300 focus:border-black focus:ring-2 focus:ring-gray-200
            @endif
            {{ $attributes->get('class') }}"
    >{{ old($name, $value) }}</textarea>
    
    @if($error)
        <p class="mt-1.5 text-sm text-red-600">{{ $error }}</p>
    @endif
</div>
