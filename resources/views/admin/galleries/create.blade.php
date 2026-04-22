@extends('layouts.admin')

@section('title', 'Nova galeria')

@section('content')
    <div class="mb-6">
        <div class="site-subtitle">Galerias institucionais</div>
        <h1 class="font-heading text-5xl mb-1">Nova galeria</h1>
        <p class="text-[#6e6e6e] mb-0">Cadastre um novo álbum de fotos do portal.</p>
    </div>

    <form method="POST" action="{{ route('admin.galleries.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.galleries._form')
    </form>
@endsection
