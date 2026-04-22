@extends('layouts.admin')

@section('title', 'Editar galeria')

@section('content')
    @include('admin.partials.status-alert')

    <div class="mb-6">
        <div class="site-subtitle">Galerias institucionais</div>
        <h1 class="font-heading text-5xl mb-1">Editar galeria</h1>
        <p class="text-[#6e6e6e] mb-0">Atualize informações, capa e fotos da galeria selecionada.</p>
    </div>

    <form method="POST" action="{{ route('admin.galleries.update', $gallery) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.galleries._form')
    </form>
@endsection
