@extends('layouts.admin')

@section('title', 'Novo banner')

@section('content')
    <div class="mb-6">
        <div class="site-subtitle">Destaques da home</div>
        <h1 class="font-heading text-5xl mb-1">Novo banner</h1>
        <p class="text-[#6e6e6e] mb-0">Cadastre um novo destaque para a home do portal.</p>
    </div>

    <form method="POST" action="{{ route('admin.banners.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.banners._form')
    </form>
@endsection
