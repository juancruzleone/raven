@extends('layouts.main')

@section('title', 'Blog')

@section('content')

<div class="contenedor-portada-blog">
    <h1 class="titulo-seccion" id="titulo-blog">Artículos</h1>
    <form action="{{ route('posts.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="s-title" class="form-control p-4" placeholder="Buscar por título" value="{{ $searchTitle }}">
            <select class="form-select mx-2" id="category_id" name="category_id">
                <option value="">Todas las categorías</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if ($selectedCategoryId == $category->id) selected @endif>{{ $category->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </div>
    </form>

    @auth
        @if(auth()->user()->hasRole('admin'))
            <div class="mb-3 text-center">
                <a href="{{ route('posts.create.form') }}" class="btn btn-dark" id="boton-crear-articulo">Crear Artículo</a>
            </div>
        @endif
    @endauth
</div>

<div class="contenedor-blog">
    {{-- Mensajes de éxito --}}
    @if(session('status'))
        <div class="alert alert-success mb-3 mt-4">
            {{ session('status') }}
        </div>
    @endif

    @if($cryptoPosts->isEmpty())
        @if(!empty($searchTitle) || !empty($selectedCategoryId))
            <p class="alerta-buscador">No se encontraron artículos para el término "<strong>{{ $searchTitle }}</strong>" en la categoría "<strong>{{ $categories->find($selectedCategoryId)->name ?? 'Todas' }}</strong>".</p>
        @else
            <p class="alerta-buscador">No se encontraron artículos.</p>
        @endif
    @else
        @if(!empty($searchTitle))
            <p class="alerta-buscador">Mostrando resultados para el término "<strong>{{ $searchTitle }}</strong>" en el título.</p>
        @endif

        @foreach($cryptoPosts as $cryptoPost)
        <article class="contenedor-posts">
            <div class="post">
                <h2><a href="{{ route('posts.view', ['id' => $cryptoPost->id]) }}">{{ $cryptoPost->title }}</a></h2>
                <p class="categoria text-center text-black">{{ $cryptoPost->category->name }}</p>
                <p class="descripcion-blog">
                    {{ Str::limit($cryptoPost->content, 200) }}
                </p>
                <a href="{{ route('posts.view', ['id' => $cryptoPost->id]) }}" class="boton-ver">Ver</a>

                @auth
                    @if(auth()->user()->email == 'juan@gmail.com' || auth()->user()->hasRole('admin'))
                        <a href="{{ route('posts.edit.form', ['id' => $cryptoPost->id]) }}" class="boton-editar">Editar</a>
                        <a href="{{ route('posts.delete.form', ['id' => $cryptoPost->id]) }}" class="boton-eliminar">Eliminar</a>
                    @endif
                @endauth
            </div>
        </article>
        @endforeach

        <div class="pagination-container"> 
            <div class="pagination-text">
                Mostrando del {{ $cryptoPosts->firstItem() }} al {{ $cryptoPosts->lastItem() }} de un total de {{ $cryptoPosts->total() }} resultados
            </div> 
            <div class="pagination-links">
                {{ $cryptoPosts->links('pagination::bootstrap-4', ['paginator' => $cryptoPosts->appends(['s-title' => $searchTitle, 'category_id' => $selectedCategoryId])->setPath(url()->current())]) }}
            </div> 
        </div>
    @endif
</div>
@endsection
