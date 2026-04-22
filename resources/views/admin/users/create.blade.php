@extends('layouts.admin')

@section('title', 'Novo Usuário')

@section('content')
    <div class="mb-6">
        <div class="site-subtitle">Controle de acesso</div>
        <h1 class="font-heading text-5xl mb-1">Novo usuário</h1>
        <p class="text-[#6e6e6e] mb-0">Crie uma nova conta administrativa para operação do portal.</p>
    </div>

    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf
        @include('admin.users._form')
    </form>
@endsection
