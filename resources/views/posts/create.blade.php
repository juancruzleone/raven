@extends('layouts.main')

@section('title', 'Publicar un nuevo artículo')

@section('content')

<section class="seccion-crear-articulo">
    <h1 class="mb-3" id="seccion-crear">Publicar un nuevo artículo</h1>

    @if($errors->any())
        <div class="alert alert-danger mb-3">
            <p>Hay errores en los datos del formulario, por favor, revísalos para corregirlos.</p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('status'))
        <div class="alert alert-success mb-3">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('posts.create.process') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input
                type="text"
                id="title"
                name="title"
                class="form-control @error('title') is-invalid @enderror"
                value="{{ old('title') }}"
                minlength="8"
                required
            >
            @error('title')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Contenido</label>
            <textarea
                id="content"
                name="content"
                class="form-control @error('content') is-invalid @enderror"
                required
            >{{ old('content') }}</textarea>
            @error('content')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Categoría</label>
            <select
                id="category_id"
                name="category_id"
                class="form-select @error('category_id') is-invalid @enderror"
            >
                <option value="">Selecciona una categoría</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="cover" class="form-label">Portada</label>
            <input type="file" id="cover" name="cover" class="form-control @error('cover') is-invalid @enderror">
            @error('cover')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <input type="hidden" name="old_cover" id="old_cover" value="{{ old('old_cover') ?? session('cover') }}">
            <div id="coverPreview" class="mt-2">
                @if(old('old_cover') || session('cover'))
                    <img src="{{ asset('storage/covers/' . (old('old_cover') ?? session('cover'))) }}" alt="Cover Image" width="200">
                @endif
            </div>
        </div>
        <div class="mb-3">
            <label for="cover_description" class="form-label">Descripción de la Portada</label>
            <input
                type="text"
                id="cover_description"
                name="cover_description"
                class="form-control @error('cover_description') is-invalid @enderror"
                value="{{ old('cover_description') }}"
                minlength="8"
                maxlength="255"
                required
            >
            @error('cover_description')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Publicar</button>
    </form>
</section>

@endsection
