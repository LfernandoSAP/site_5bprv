@extends('layouts.admin')

@section('title', 'Editar página')

@section('content')
    <div class="mb-6">
        <div class="site-subtitle">Conteúdo institucional</div>
        <h1 class="font-heading text-5xl mb-1">Editar página</h1>
        <p class="text-[#6e6e6e] mb-0">Atualize o conteúdo institucional selecionado.</p>
    </div>

    <form method="POST" action="{{ route('admin.pages.update', $page) }}">
        @csrf
        @method('PUT')
        @include('admin.pages._form')
    </form>
@endsection
