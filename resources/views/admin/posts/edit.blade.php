@extends('layouts.admin')

@section('title', 'Editar notícia')

@section('content')
    <div class="mb-6">
        <div class="site-subtitle">Módulo editorial</div>
        <h1 class="font-heading text-5xl mb-1">Editar notícia</h1>
        <p class="text-[#6e6e6e] mb-0">Atualize os dados da publicação.</p>
    </div>

    <form method="POST" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.posts._form')
    </form>
@endsection
