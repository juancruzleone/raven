@extends('layouts.main')

@section('title', 'Listado de Usuarios')

@section('content')
    <section class="contenedor-login">
        <div class="contenedor-portada">
            <h1 class="mb-10 titulo-seccion">Listado de usuarios subscriptos</h1>
        </div>
        <div class="contenedor-lista-usuarios">
            <ul class="lista-usuarios">
                @foreach($users as $user)
                    <li>{{ $user->name }} - {{ $user->email }} ({{ $user->roles->first()->name }})</li>
                @endforeach
            </ul>
        </div>
    </section>
@endsection
