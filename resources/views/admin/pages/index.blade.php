@extends('layouts.admin')

@section('title', 'Páginas')

@section('content')
    @include('admin.partials.status-alert')

    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end gap-3 mb-6">
        <div>
            <div class="site-subtitle">Conteúdo institucional</div>
            <h1 class="font-heading text-5xl mb-1">Páginas institucionais</h1>
            <p class="text-[#6e6e6e] mb-0">Gerencie páginas permanentes como histórico, área de atuação e conteúdo institucional.</p>
        </div>
        <a href="{{ route('admin.pages.create') }}" class="px-4 py-3 bg-[#101010] text-white rounded-full">Nova página</a>
    </div>

    <div class="admin-card p-4">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-3 px-2 font-semibold text-[#6e6e6e]">Título</th>
                        <th class="text-left py-3 px-2 font-semibold text-[#6e6e6e]">Status</th>
                        <th class="text-left py-3 px-2 font-semibold text-[#6e6e6e]">Publicação</th>
                        <th class="text-right py-3 px-2 font-semibold text-[#6e6e6e]">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pages as $page)
                        <tr class="border-b border-gray-100 hover:bg-gray-50/50">
                            <td class="py-3 px-2">
                                <div class="font-semibold">{{ $page->title }}</div>
                                <div class="text-sm text-[#6e6e6e]">{{ $page->slug }}</div>
                            </td>
                            <td class="py-3 px-2">
                                @if($page->status === 'published')
                                    <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Publicado</span>
                                @else
                                    <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-600">Rascunho</span>
                                @endif
                            </td>
                            <td class="py-3 px-2 text-sm text-[#6e6e6e]">{{ optional($page->published_at)->format('d/m/Y H:i') ?? 'Não publicada' }}</td>
                            <td class="py-3 px-2 text-right">
                                <div class="inline-flex gap-2">
                                    <a href="{{ route('admin.pages.edit', $page) }}" class="px-3 py-1.5 text-sm border border-[#101010]/18 text-[#101010] rounded-full hover:bg-[#101010] hover:text-white transition">Editar</a>
                                    <form method="POST" action="{{ route('admin.pages.destroy', $page) }}" onsubmit="return confirm('Deseja remover esta página?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1.5 text-sm border border-red-300 text-red-600 rounded-full hover:bg-red-600 hover:text-white hover:border-red-600 transition">Excluir</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-12 text-center text-[#6e6e6e]">Nenhuma página cadastrada ainda.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pt-4">{{ $pages->links() }}</div>
    </div>
@endsection
