@extends('layouts.main')

@section('title', 'Iniciar Sesión')

@section('content')
    <section class="contenedor-auth">
        <div>
            <h1 class="mb-4 text-black">Ingresa a tu Cuenta</h1>
            @if(session('status'))
                <div class="alert {{ session('alert-class', 'alert-success') }} alert-auth mb-3" id="status-alert">
                    {{ session('status') }}
                </div>
                @php
                    // Establecer el tiempo de duración del alert en segundos
                    $alert_duration = 3;
                @endphp
                <script>
                    // Ocultar el alert después del tiempo establecido
                    setTimeout(function() {
                        document.getElementById('status-alert').style.display = 'none';
                    }, {{ $alert_duration * 1000 }});
                </script>
            @endif
        </div>
        <div class="contenedor-form-auth">
            <form action="{{ route('auth.login.process') }}" method="post" class="form-auth">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label text-white">Email</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="alert alert-danger alert-auth mt2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label text-white">Contraseña</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                    @error('password')
                        <div class="alert alert-danger alert-auth mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-dark" id="boton-form">Ingresar</button> 
            </form>
        </div>
    </section>
@endsection
