@extends('layouts.admin')

@section('title', 'Nova notícia')

@section('content')
    <div class="mb-6">
        <div class="site-subtitle">Módulo editorial</div>
        <h1 class="font-heading text-5xl mb-1">Nova notícia</h1>
        <p class="text-[#6e6e6e] mb-0">Cadastre uma nova publicação institucional.</p>
    </div>

    <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.posts._form')
    </form>
@endsection
