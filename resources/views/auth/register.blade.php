@extends('layouts.main')

@section('title', 'Registrarse')

@section('content')
<section class="contenedor-auth">
    @if(session('status'))
        <div class="alert {{ session('alert-class', 'alert-success') }} alert-auth mb-3">
            {{ session('status') }}
        </div>
    @endif
    <h1 class="mb-4 text-black">Crea tu Cuenta</h1>
    <div class="contenedor-form-auth-register">
      
        <form action="{{ route('auth.register.process') }}" method="post" class="form-auth">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label text-white">Nombre</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" minlength="4" required>
                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label text-white">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}">
                @error('email')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3 password-container">
                <label for="password" class="form-label text-white">Contraseña</label>
                <input type="password" id="password" name="password" class="form-control" minlength="8" required>
                <img src="{{ asset('eye.png') }}" alt="Mostrar/Ocultar contraseña" class="password-toggle" onclick="togglePassword()">
                @error('password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            @if($errors->has('register'))
                <p class="text-danger">{{ $errors->first('register') }}</p>
            @endif
            <button type="submit" class="btn btn-dark" id="boton-form">Registrarse</button>
        </form>
    </div>
</section>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const passwordToggle = document.querySelector('.password-toggle');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            passwordToggle.src = '{{ asset('eye-close.png') }}'; // Cambia a la imagen de ojo cerrado
        } else {
            passwordInput.type = 'password';
            passwordToggle.src = '{{ asset('eye.png') }}'; // Cambia a la imagen del ojo normal
        }
    }
</script>

@endsection
