@extends('layouts.admin')

@section('title', 'Usuários')

@section('content')
    @include('admin.partials.status-alert')

    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end gap-3 mb-6">
        <div>
            <div class="site-subtitle">Controle de acesso</div>
            <h1 class="font-heading text-5xl mb-1">Usuários do portal</h1>
            <p class="text-[#6e6e6e] mb-0">Gerencie administradores e editores com controle simples de perfil e status de acesso.</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="px-4 py-3 bg-[#101010] text-white rounded-full">Novo usuário</a>
    </div>

    <div class="admin-card p-4">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-3 px-2 font-semibold text-[#6e6e6e]">Usuário</th>
                        <th class="text-left py-3 px-2 font-semibold text-[#6e6e6e]">Perfil</th>
                        <th class="text-left py-3 px-2 font-semibold text-[#6e6e6e]">Status</th>
                        <th class="text-left py-3 px-2 font-semibold text-[#6e6e6e]">Último acesso</th>
                        <th class="text-right py-3 px-2 font-semibold text-[#6e6e6e]">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr class="border-b border-gray-100 hover:bg-gray-50/50">
                            <td class="py-3 px-2">
                                <div class="font-semibold">{{ $user->name }}</div>
                                <div class="text-sm text-[#6e6e6e]">{{ $user->email }}</div>
                            </td>
                            <td class="py-3 px-2">
                                @if($user->role === 'admin')
                                    <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full bg-gray-900 text-white">Administrador</span>
                                @else
                                    <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-600">Editor</span>
                                @endif
                            </td>
                            <td class="py-3 px-2">
                                @if($user->is_active)
                                    <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Ativo</span>
                                @else
                                    <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-600">Inativo</span>
                                @endif
                            </td>
                            <td class="py-3 px-2 text-sm text-[#6e6e6e]">{{ optional($user->last_login_at)->format('d/m/Y H:i') ?? 'Sem registro' }}</td>
                            <td class="py-3 px-2 text-right">
                                <div class="inline-flex gap-2">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="px-3 py-1.5 text-sm border border-[#101010]/18 text-[#101010] rounded-full hover:bg-[#101010] hover:text-white transition">Editar</a>
                                    @if (! auth()->user()->is($user))
                                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Deseja remover este usuário?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1.5 text-sm border border-red-300 text-red-600 rounded-full hover:bg-red-600 hover:text-white hover:border-red-600 transition">Excluir</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-[#6e6e6e]">Nenhum usuário cadastrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pt-4">{{ $users->links() }}</div>
    </div>
@endsection
