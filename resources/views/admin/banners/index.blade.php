@extends('layouts.admin')

@section('title', 'Banners')

@section('content')
    @include('admin.partials.status-alert')

    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end gap-3 mb-6">
        <div>
            <div class="site-subtitle">Destaques da home</div>
            <h1 class="font-heading text-5xl mb-1">Banners</h1>
            <p class="text-[#6e6e6e] mb-0">Gerencie os destaques principais exibidos na abertura do portal.</p>
        </div>
        <a href="{{ route('admin.banners.create') }}" class="px-4 py-3 bg-[#101010] text-white rounded-full">Novo banner</a>
    </div>

    <div class="admin-card p-4">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-3 px-2 font-semibold text-[#6e6e6e]">Título</th>
                        <th class="text-left py-3 px-2 font-semibold text-[#6e6e6e]">Ordem</th>
                        <th class="text-left py-3 px-2 font-semibold text-[#6e6e6e]">Status</th>
                        <th class="text-left py-3 px-2 font-semibold text-[#6e6e6e]">Link</th>
                        <th class="text-right py-3 px-2 font-semibold text-[#6e6e6e]">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($banners as $banner)
                        <tr class="border-b border-gray-100 hover:bg-gray-50/50">
                            <td class="py-3 px-2">
                                <div class="font-semibold">{{ $banner->title }}</div>
                                <div class="text-sm text-[#6e6e6e]">{{ $banner->subtitle }}</div>
                            </td>
                            <td class="py-3 px-2">{{ $banner->sort_order }}</td>
                            <td class="py-3 px-2">
                                @if($banner->is_active)
                                    <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Ativo</span>
                                @else
                                    <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-600">Inativo</span>
                                @endif
                            </td>
                            <td class="py-3 px-2 text-sm text-[#6e6e6e]">{{ $banner->link_url ?: 'Sem link' }}</td>
                            <td class="py-3 px-2 text-right">
                                <div class="inline-flex gap-2">
                                    <a href="{{ route('admin.banners.edit', $banner) }}" class="px-3 py-1.5 text-sm border border-[#101010]/18 text-[#101010] rounded-full hover:bg-[#101010] hover:text-white transition">Editar</a>
                                    <form method="POST" action="{{ route('admin.banners.destroy', $banner) }}" onsubmit="return confirm('Deseja remover este banner?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1.5 text-sm border border-red-300 text-red-600 rounded-full hover:bg-red-600 hover:text-white hover:border-red-600 transition">Excluir</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-[#6e6e6e]">Nenhum banner cadastrado ainda.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pt-4">
            {{ $banners->links() }}
        </div>
    </div>
@endsection
