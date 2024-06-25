@extends('layouts.main')

@section('title', 'Editar el artículo: ' . $post->title)

@section('content')
<article id="seccion-editar">
    <h1 class="mb-3">Editar {{ $post->title }}</h1>

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

    <form action="{{ route('posts.edit.process', ['id' => $post->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input
                type="text"
                id="title"
                name="title"
                class="form-control @error('title') is-invalid @enderror"
                value="{{ old('title', $post->title) }}"
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
                minlength="8"
                required
            >{{ old('content', $post->content) }}</textarea>
            @error('content')
                @if($message == 'validation.required')
                    <p class="text-danger">El campo de contenido no puede estar vacío</p>
                @else
                    <p class="text-danger">{{ $message }}</p>
                @endif
            @enderror
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Categoría</label>
            <select
                id="category_id"
                name="category_id"
                class="form-select @error('category_id') is-invalid @enderror"
            >
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == old('category_id', $post->category_id) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        {{-- Mostrar la imagen actual --}}
        <div class="mb-3">
            <label for="cover" class="form-label">Portada</label>
            <input type="file" id="cover" name="cover" class="form-control @error('cover') is-invalid @enderror">
            @error('cover')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        @if ($post->cover)
            <div class="mb-3">
                <label>Imagen Actual</label>
                <img src="{{ asset('storage/covers/' . $post->cover) }}" alt="{{ $post->title }}" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
            </div>
        @endif

        <div class="mb-3">
            <label for="cover_description" class="form-label">Descripción de la Portada</label>
            <input
                type="text"
                id="cover_description"
                name="cover_description"
                class="form-control @error('cover_description') is-invalid @enderror"
                value="{{ old('cover_description', $post->cover_description) }}"
                minlength="8"
                maxlength="255"
                required
            >
            @error('cover_description')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</article>
@endsection
