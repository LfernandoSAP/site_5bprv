@extends('layouts.admin')

@section('title', 'Editar banner')

@section('content')
    <div class="mb-6">
        <div class="site-subtitle">Destaques da home</div>
        <h1 class="font-heading text-5xl mb-1">Editar banner</h1>
        <p class="text-[#6e6e6e] mb-0">Atualize o destaque selecionado para a home do portal.</p>
    </div>

    <form method="POST" action="{{ route('admin.banners.update', $banner) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.banners._form')
    </form>
@endsection
