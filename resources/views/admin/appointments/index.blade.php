@extends('layouts.admin')

@section('title', 'Agendamentos')

@section('content')
    @include('admin.partials.status-alert')

    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end gap-3 mb-8">
        <div>
            <div class="site-subtitle">Módulo de Gestão</div>
            <h1 class="font-heading text-6xl mb-1 leading-none">Agendamentos</h1>
            <p class="text-[#6e6e6e] text-lg">Controle de visitas, reuniões e solicitações institucionais do 5º BPRv.</p>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="admin-card p-6 border-l-4 border-blue-500">
            <div class="text-sm font-bold uppercase tracking-widest text-gray-400 mb-1">Total</div>
            <div class="stat-number text-4xl">{{ $stats['total'] }}</div>
        </div>
        <div class="admin-card p-6 border-l-4 border-yellow-500">
            <div class="text-sm font-bold uppercase tracking-widest text-yellow-600 mb-1">Pendentes</div>
            <div class="stat-number text-4xl text-yellow-600">{{ $stats['pending'] }}</div>
        </div>
        <div class="admin-card p-6 border-l-4 border-green-500">
            <div class="text-sm font-bold uppercase tracking-widest text-green-600 mb-1">Confirmados</div>
            <div class="stat-number text-4xl text-green-600">{{ $stats['confirmed'] }}</div>
        </div>
    </div>

    <div class="admin-card p-4">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-4 px-3 font-bold text-[#6e6e6e] uppercase text-xs tracking-wider">Solicitante</th>
                        <th class="text-left py-4 px-3 font-bold text-[#6e6e6e] uppercase text-xs tracking-wider">Data / Hora</th>
                        <th class="text-left py-4 px-3 font-bold text-[#6e6e6e] uppercase text-xs tracking-wider">Local / Motivo</th>
                        <th class="text-left py-4 px-3 font-bold text-[#6e6e6e] uppercase text-xs tracking-wider">Status</th>
                        <th class="text-right py-4 px-3 font-bold text-[#6e6e6e] uppercase text-xs tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($appointments as $appointment)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="py-4 px-3">
                                <div class="font-bold text-gray-900">{{ $appointment->name }}</div>
                                <div class="text-xs text-gray-500 font-mono">{{ $appointment->cpf }}</div>
                                <div class="text-xs text-gray-500">{{ $appointment->phone }}</div>
                            </td>
                            <td class="py-4 px-3">
                                <div class="font-medium">{{ $appointment->date->format('d/m/Y') }}</div>
                                <div class="text-xs text-[#d5aa32] font-bold">{{ \Carbon\Carbon::parse($appointment->time_slot)->format('H:i') }}h</div>
                            </td>
                            <td class="py-4 px-3">
                                <div class="text-sm font-semibold text-gray-700">{{ $appointment->location }}</div>
                                <div class="text-xs text-gray-500">{{ Str::limit($appointment->purpose, 40) }}</div>
                            </td>
                            <td class="py-4 px-3">
                                @php
                                    $statusClasses = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'confirmed' => 'bg-green-100 text-green-800',
                                        'cancelled' => 'bg-red-100 text-red-800',
                                        'completed' => 'bg-gray-100 text-gray-800',
                                    ];
                                @endphp
                                <span class="px-3 py-1 text-[10px] font-bold uppercase rounded-full {{ $statusClasses[$appointment->status] }}">
                                    {{ $appointment->status }}
                                </span>
                            </td>
                            <td class="py-4 px-3 text-right">
                                <div class="flex justify-end gap-2">
                                    <div x-data="{ open: false }" class="relative">
                                        <button @click="open = !open" class="px-3 py-1.5 text-xs bg-white border border-gray-200 rounded-full hover:border-[#d5aa32] transition shadow-sm font-bold">Status</button>
                                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-40 bg-[#101010] rounded-2xl shadow-xl z-10 overflow-hidden border border-white/10" x-cloak>
                                            @foreach(['pending', 'confirmed', 'cancelled', 'completed'] as $st)
                                                <form method="POST" action="{{ ag('appointments/' . $appointment->id . '/status') }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="{{ $st }}">
                                                    <button type="submit" class="w-full text-left px-4 py-2 text-xs text-white hover:bg-[#d5aa32] hover:text-black transition-colors font-bold uppercase tracking-widest">{{ $st }}</button>
                                                </form>
                                            @endforeach
                                        </div>
                                    </div>
                                    <form method="POST" action="{{ ag('appointments/' . $appointment->id) }}" onsubmit="return confirmDelete(this, 'Remover Agendamento', 'Deseja excluir este registro de agendamento permanentemente?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-red-600 hover:bg-red-50 rounded-full transition" title="Excluir">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-[#6e6e6e]">Nenhum agendamento encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pt-4">{{ $appointments->links() }}</div>
    </div>
@endsection
