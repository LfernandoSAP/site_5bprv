@extends('layouts.admin')

@section('title', 'Editar Usuário')

@section('content')
    <div class="mb-6">
        <div class="site-subtitle">Controle de acesso</div>
        <h1 class="font-heading text-5xl mb-1">Editar usuário</h1>
        <p class="text-[#6e6e6e] mb-0">Atualize perfil, status de acesso e credenciais da conta selecionada.</p>
    </div>

    <form method="POST" action="{{ route('admin.users.update', $user) }}">
        @csrf
        @method('PUT')
        @include('admin.users._form')
    </form>
@endsection
