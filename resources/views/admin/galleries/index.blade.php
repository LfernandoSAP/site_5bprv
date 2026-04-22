@extends('layouts.admin')

@section('title', 'Galerias')

@section('content')
    @include('admin.partials.status-alert')

    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end gap-3 mb-6">
        <div>
            <div class="site-subtitle">Galerias institucionais</div>
            <h1 class="font-heading text-5xl mb-1">Galerias</h1>
            <p class="text-[#6e6e6e] mb-0">Organize álbuns de fotos e seus destaques institucionais.</p>
        </div>
        <a href="{{ route('admin.galleries.create') }}" class="px-4 py-3 bg-[#101010] text-white rounded-full">Nova galeria</a>
    </div>

    <div class="admin-card p-4">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-3 px-2 font-semibold text-[#6e6e6e]">Título</th>
                        <th class="text-left py-3 px-2 font-semibold text-[#6e6e6e]">Status</th>
                        <th class="text-left py-3 px-2 font-semibold text-[#6e6e6e]">Fotos</th>
                        <th class="text-left py-3 px-2 font-semibold text-[#6e6e6e]">Publicação</th>
                        <th class="text-right py-3 px-2 font-semibold text-[#6e6e6e]">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($galleries as $gallery)
                        <tr class="border-b border-gray-100 hover:bg-gray-50/50">
                            <td class="py-3 px-2">
                                <div class="font-semibold">{{ $gallery->title }}</div>
                                <div class="text-sm text-[#6e6e6e]">{{ $gallery->slug }}</div>
                            </td>
                            <td class="py-3 px-2">
                                @if($gallery->status === 'published')
                                    <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Publicada</span>
                                @else
                                    <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-600">Rascunho</span>
                                @endif
                            </td>
                            <td class="py-3 px-2">{{ $gallery->photos_count }}</td>
                            <td class="py-3 px-2 text-sm text-[#6e6e6e]">{{ optional($gallery->published_at)->format('d/m/Y H:i') ?? 'Não publicada' }}</td>
                            <td class="py-3 px-2 text-right">
                                <div class="inline-flex gap-2">
                                    <a href="{{ route('admin.galleries.edit', $gallery) }}" class="px-3 py-1.5 text-sm border border-[#101010]/18 text-[#101010] rounded-full hover:bg-[#101010] hover:text-white transition">Editar</a>
                                    <form method="POST" action="{{ route('admin.galleries.destroy', $gallery) }}" onsubmit="return confirm('Deseja remover esta galeria?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1.5 text-sm border border-red-300 text-red-600 rounded-full hover:bg-red-600 hover:text-white hover:border-red-600 transition">Excluir</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-[#6e6e6e]">Nenhuma galeria cadastrada ainda.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pt-4">{{ $galleries->links() }}</div>
    </div>
@endsection
