@extends('layouts.admin')

@section('title', 'Configurações')

@section('content')
    @include('admin.partials.status-alert')

    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end gap-3 mb-6">
        <div>
            <div class="site-subtitle">Parâmetros institucionais</div>
            <h1 class="font-heading text-5xl mb-1">Configurações do portal</h1>
            <p class="text-[#6e6e6e] mb-0">Mantenha a identidade institucional, os dados de contato e os links públicos do portal em um único lugar.</p>
        </div>
        <a href="{{ route('public.home') }}" class="px-4 py-3 border border-[#101010]/18 text-[#101010] rounded-full hover:bg-[#101010] hover:text-white transition">Ver portal público</a>
    </div>

    <form method="POST" action="{{ route('admin.settings.update') }}">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-4">
            <div class="xl:col-span-2">
                <div class="admin-card p-4 h-full">
                    <div class="section-label text-[#202020] mb-3">Identidade</div>
                    <div class="mb-4">
                        <label for="portal_name" class="block font-semibold text-[#202020] mb-1">Nome do portal</label>
                        <input type="text" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl @error('portal_name') border-red-300 bg-red-50 @enderror" id="portal_name" name="portal_name" value="{{ old('portal_name', $settings['portal_name']) }}" required>
                        @error('portal_name')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-6">
                        <label for="portal_subtitle" class="block font-semibold text-[#202020] mb-1">Subtítulo</label>
                        <input type="text" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl @error('portal_subtitle') border-red-300 bg-red-50 @enderror" id="portal_subtitle" name="portal_subtitle" value="{{ old('portal_subtitle', $settings['portal_subtitle']) }}">
                        @error('portal_subtitle')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror
                    </div>

                    <div class="section-label text-[#202020] mb-3">Contato</div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-4">
                        <div class="md:col-span-2">
                            <label for="address" class="block font-semibold text-[#202020] mb-1">Endereço</label>
                            <input type="text" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl @error('address') border-red-300 bg-red-50 @enderror" id="address" name="address" value="{{ old('address', $settings['address']) }}">
                            @error('address')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label for="phone" class="block font-semibold text-[#202020] mb-1">Telefone</label>
                            <input type="text" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl @error('phone') border-red-300 bg-red-50 @enderror" id="phone" name="phone" value="{{ old('phone', $settings['phone']) }}">
                            @error('phone')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="section-label text-[#202020] mb-3">Presença digital</div>
                    <div>
                        <label for="instagram_url" class="block font-semibold text-[#202020] mb-1">Instagram institucional</label>
                        <input type="url" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl @error('instagram_url') border-red-300 bg-red-50 @enderror" id="instagram_url" name="instagram_url" value="{{ old('instagram_url', $settings['instagram_url']) }}" placeholder="https://www.instagram.com/...">
                        @error('instagram_url')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="xl:col-span-1">
                <div class="admin-card p-4 mb-4">
                    <div class="section-label text-[#202020] mb-3">Rodapé</div>
                    <div class="mb-4">
                        <label for="footer_text" class="block font-semibold text-[#202020] mb-1">Texto institucional</label>
                        <textarea class="w-full px-4 py-2.5 border border-gray-300 rounded-xl resize-y min-h-[150px] @error('footer_text') border-red-300 bg-red-50 @enderror" id="footer_text" name="footer_text" rows="8">{{ old('footer_text', $settings['footer_text']) }}</textarea>
                        @error('footer_text')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div class="space-y-2">
                        <button type="submit" class="w-full px-4 py-3 bg-[#101010] text-white rounded-xl hover:bg-gray-900 transition">Salvar configurações</button>
                        <a href="{{ route('admin.dashboard') }}" class="block w-full px-4 py-3 text-center border border-[#101010]/18 text-[#101010] rounded-xl hover:bg-[#101010] hover:text-white transition">Voltar ao dashboard</a>
                    </div>
                </div>

                <div class="admin-card p-4">
                    <div class="site-subtitle">Impacto no portal</div>
                    <h2 class="font-heading text-xl mb-3">Onde isso aparece</h2>
                    <p class="text-[#6e6e6e] mb-2">Esses dados alimentam automaticamente:</p>
                    <ul class="mb-0 text-[#6e6e6e] space-y-1">
                        <li>topo e rodapé do portal público</li>
                        <li>metadados institucionais da home</li>
                        <li>contato e link social nas páginas públicas</li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
@endsection
