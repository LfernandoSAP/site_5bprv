@extends('layouts.admin')

@section('title', 'Nova página')

@section('content')
    <div class="mb-6">
        <div class="site-subtitle">Conteúdo institucional</div>
        <h1 class="font-heading text-5xl mb-1">Nova página</h1>
        <p class="text-[#6e6e6e] mb-0">Cadastre uma nova página institucional para o portal.</p>
    </div>

    <form method="POST" action="{{ route('admin.pages.store') }}">
        @csrf
        @include('admin.pages._form')
    </form>
@endsection
