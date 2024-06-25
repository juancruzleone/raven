@extends('layouts.main')

@section('title', 'Confirmación para eliminar el artículo: ' . $post->title)

@section('content')
<article class="seccion-eliminar">
    <div class="contenedor-portada-eliminar">
        <h1>Confirmación para Eliminar {{ $post->title }}</h1>
        <p>Estás pidiendo eliminar el siguiente artículo: <span>{{ $post->title }}</span></p>
    </div>
    <h2 class="mb-3">{{ $post->title }}</h2>
    <div class="row mb-3">
        <div class="col-8">
            <dl>
                <dt>Fecha de Publicación</dt>
                <dd>{{ $post->created_at }}</dd>
            </dl>
        </div>
        <div class="img-eliminar">
            <img src="{{ asset('/public/covers/' . $post->cover) }}" alt="{{ $post->cover_description }}" class="img-fluid">
        </div>
    </div>
    <h3>Contenido</h3>
    <div>{{ $post->content }}</div>
    <hr>
    <p>¿Realmente quieres eliminar este artículo?</p>
    <form action="{{ route('posts.delete.process', ['id' => $post->id]) }}" method="post">
        @csrf
        <button type="submit" class="btn btn-danger">Sí, quiero eliminar el artículo {{ $post->title }}</button>
    </form>
</article>
@endsection
