@extends('layouts.main')

@section('title', $post->title)

@section('content')
<article class="seccion-detalle">
    <h1 class="mb-3">{{ $post->title }}</h1>
    <p class="mb-3 categoria-detalle">{{ $post->category->name }}</p>
    <div class="row mb-3">
        <div class="col-8">
            <dl>
                <dt>Fecha de Publicación</dt>
                <dd>{{ $post->created_at->format('d/m/Y') }}</dd>
            </dl>
        </div>
    </div>
    <div class="mb-3">
        <img src="{{ asset('public/covers/' . $post->cover) }}" alt="{{ $post->cover_description }}" class="img-fluid" id="portada-blog">
    </div>
    <section class="seccion-contenido">
        <h2>Contenido</h2>
        <p>{!! $post->content !!}</p>
    </section>
</article>
@endsection
