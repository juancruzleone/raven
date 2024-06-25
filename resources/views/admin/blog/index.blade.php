@extends('layouts.admin')

@section('title', 'Administración del blog de criptomonedas')

@section('contenido')
    <h1>Administración del blog de criptomonedas</h1>

    <a href="{{ route('crypto_posts.createForm') }}" class="btn btn-primary">Crear nuevo post</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Título</th>
                <th>Precio</th>
                <th>Fecha de Publicación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->price }}</td>
                    <td>{{ $post->release_date }}</td>
                    <td>
                        <a href="{{ route('crypto_posts.view', ['id' => $post->id]) }}" class="btn btn-primary">Ver</a>
                        <a href="{{ route('crypto_posts.editForm', ['id' => $post->id]) }}" class="btn btn-warning">Editar</a>
                        <a href="{{ route('crypto_posts.deleteForm', ['id' => $post->id]) }}" class="btn btn-danger">Eliminar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
