@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end gap-3 mb-6">
        <div>
            <div class="site-subtitle">Fase 4</div>
            <h1 class="font-heading text-5xl mb-1">Dashboard administrativo</h1>
            <p class="text-[#6e6e6e] mb-0">Painel consolidado para operação editorial, gestão institucional e preparação de publicação em ambiente Apache.</p>
        </div>
        <a href="{{ route('public.home') }}" class="px-4 py-2 border border-[#101010]/18 text-[#101010] rounded-full hover:bg-[#101010] hover:text-white transition whitespace-nowrap">Ver portal público</a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">
        <div class="admin-card p-4 h-full">
            <div class="site-subtitle">Notícias</div>
            <div class="stat-number">{{ $stats['posts'] }}</div>
            <div class="text-[#6e6e6e]">publicações cadastradas</div>
        </div>
        <div class="admin-card p-4 h-full">
            <div class="site-subtitle">Páginas</div>
            <div class="stat-number">{{ $stats['pages'] }}</div>
            <div class="text-[#6e6e6e]">páginas institucionais</div>
        </div>
        <div class="admin-card p-4 h-full">
            <div class="site-subtitle">Banners</div>
            <div class="stat-number">{{ $stats['banners'] }}</div>
            <div class="text-[#6e6e6e]">destaques configurados</div>
        </div>
        <div class="admin-card p-4 h-full">
            <div class="site-subtitle">Galerias</div>
            <div class="stat-number">{{ $stats['galleries'] }}</div>
            <div class="text-[#6e6e6e]">álbuns institucionais</div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-4">
        <div class="xl:col-span-2">
            <div class="admin-card p-4 h-full">
                <div class="site-subtitle">Operação do portal</div>
                <h2 class="font-heading text-4xl mb-3">Acessos rápidos</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <a href="{{ route('admin.posts.index') }}" class="admin-quick-link">
                        <h3 class="font-heading text-2xl">Notícias</h3>
                        <p class="text-[#6e6e6e] mb-0">Gerencie publicações editoriais, destaques e status de publicação.</p>
                    </a>
                    <a href="{{ route('admin.banners.index') }}" class="admin-quick-link">
                        <h3 class="font-heading text-2xl">Banners</h3>
                        <p class="text-[#6e6e6e] mb-0">Organize o bloco principal da home com destaque institucional.</p>
                    </a>
                    <a href="{{ route('admin.pages.index') }}" class="admin-quick-link">
                        <h3 class="font-heading text-2xl">Páginas</h3>
                        <p class="text-[#6e6e6e] mb-0">Atualize histórico, conteúdos oficiais e seções permanentes do portal.</p>
                    </a>
                    <a href="{{ route('admin.galleries.index') }}" class="admin-quick-link">
                        <h3 class="font-heading text-2xl">Galerias</h3>
                        <p class="text-[#6e6e6e] mb-0">Mantenha o acervo visual com capas, fotos e organização editorial.</p>
                    </a>
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('admin.users.index') }}" class="admin-quick-link">
                            <h3 class="font-heading text-2xl">Usuários</h3>
                            <p class="text-[#6e6e6e] mb-0">Gerencie administradores, editores, status de acesso e manutenção de contas.</p>
                        </a>
                        <a href="{{ route('admin.settings.edit') }}" class="admin-quick-link">
                            <h3 class="font-heading text-2xl">Configurações</h3>
                            <p class="text-[#6e6e6e] mb-0">Atualize nome do portal, contato institucional, redes e conteúdo do rodapé.</p>
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <div>
            <div class="admin-card p-4 h-full">
                <div class="site-subtitle">Conteúdo recente</div>
                <h2 class="font-heading text-4xl mb-3">Últimas publicações</h2>
                @if ($recentPosts->isEmpty())
                    <div class="border rounded-2xl p-4 text-[#6e6e6e]">Ainda não há notícias publicadas. O painel já está pronto para iniciar a alimentação do portal.</div>
                @else
                    <div class="space-y-0">
                        @foreach ($recentPosts as $post)
                            <div class="py-3 border-b border-gray-100 last:border-0">
                                <div class="font-heading text-2xl mb-1">{{ $post->title }}</div>
                                <div class="text-sm text-[#6e6e6e]">{{ $post->status }} &bull; {{ optional($post->published_at)->format('d/m/Y H:i') ?? 'sem publicação' }}</div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
