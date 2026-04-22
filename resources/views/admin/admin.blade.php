<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') &bull; {{ config('app.name', 'Portal 5º BPRv') }}</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="admin-shell">
    <div class="admin-topbar text-white py-3 border-bottom border-yellow-600/25">
        <div class="flex flex-wrap justify-between items-center gap-3 px-4">
            <div>
                <div class="site-subtitle text-white/50">Painel administrativo</div>
                <div class="font-heading text-2xl mb-0">Portal 5º BPRv</div>
            </div>
            <div class="flex items-center gap-3">
                <span class="small text-white/50">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="px-3 py-1.5 text-sm border border-white/30 text-white/80 rounded-full hover:bg-white/10 hover:text-white transition">Sair</button>
                </form>
            </div>
        </div>
    </div>

    <div class="flex flex-col lg:flex-row">
        <aside class="w-full lg:w-72 p-4 bg-[#101010]/95 text-white/90">
            <div class="mb-4">
                <div class="font-heading text-xl text-[#d5aa32]">Gestão do Portal</div>
                <p class="mb-0 small text-white/50">Base preparada para conteúdo institucional, notícias, banners e galerias.</p>
            </div>
            <nav class="flex flex-col gap-1">
                <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'bg-[#d5aa32]/20 text-white' : 'text-white/80 hover:bg-white/5 hover:text-white' }}">Dashboard</a>
                <a href="{{ route('admin.posts.index') }}" class="px-3 py-2 rounded-xl {{ request()->routeIs('admin.posts.*') ? 'bg-[#d5aa32]/20 text-white' : 'text-white/80 hover:bg-white/5 hover:text-white' }}">Notícias</a>
                <a href="{{ route('admin.banners.index') }}" class="px-3 py-2 rounded-xl {{ request()->routeIs('admin.banners.*') ? 'bg-[#d5aa32]/20 text-white' : 'text-white/80 hover:bg-white/5 hover:text-white' }}">Banners</a>
                <a href="{{ route('admin.pages.index') }}" class="px-3 py-2 rounded-xl {{ request()->routeIs('admin.pages.*') ? 'bg-[#d5aa32]/20 text-white' : 'text-white/80 hover:bg-white/5 hover:text-white' }}">Páginas institucionais</a>
                <a href="{{ route('admin.galleries.index') }}" class="px-3 py-2 rounded-xl {{ request()->routeIs('admin.galleries.*') ? 'bg-[#d5aa32]/20 text-white' : 'text-white/80 hover:bg-white/5 hover:text-white' }}">Galerias</a>
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('admin.users.index') }}" class="px-3 py-2 rounded-xl {{ request()->routeIs('admin.users.*') ? 'bg-[#d5aa32]/20 text-white' : 'text-white/80 hover:bg-white/5 hover:text-white' }}">Usuários</a>
                    <a href="{{ route('admin.settings.edit') }}" class="px-3 py-2 rounded-xl {{ request()->routeIs('admin.settings.*') ? 'bg-[#d5aa32]/20 text-white' : 'text-white/80 hover:bg-white/5 hover:text-white' }}">Configurações</a>
                @endif
            </nav>
        </aside>
        <section class="flex-1 p-4 lg:p-8">
            @yield('content')
        </section>
    </div>
</body>
</html>
