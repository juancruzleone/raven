<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/styles.css') }}">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}" id="logo-nav">RAV3N</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto" id="main-links">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('vip') }}">Vip</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('blog') }}">Blog</a>
                        </li>
                        @auth
                            @if(auth()->user()->hasRole('admin')) <!-- Verificación del rol 'admin' -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.list') }}">Lista de usuarios</a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <span class="nav-link" id="usuario-nav"><b>{{ auth()->user()->email }}</b></span>
                            </li>
                            <li class="nav-item">
                                <form action="{{ route('auth.logout.process') }}" method="post">
                                    @csrf
                                    <button type="submit" class="icono-auth">
                                        <img src="{{ asset('cerrar-sesion.webp') }}" alt="Icono cerrar sesión">
                                    </button>
                                </form>
                            </li>
                        @else
                            <li class="iniciar-sesion">
                                <a href="{{ route('auth.login.form') }}">Iniciar sesión</a>
                            </li>
                            <li class="registrarse">
                                <a href="{{ route('auth.register.form') }}">Registrarse</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
        <main>
            @if(\Session::has('status.message'))
                <div class="alert {{ 'alert-' . \Session::get('status.type', 'success') }}">{!! \Session::get('status.message') !!}</div>
            @endif
            @yield('content')
        </main>
        <footer class="footer">
            <div class="contenedor-footer">
                <div class="row">
                    <div class="col-md-6">
                        <h4 id="titulo-footer">RAV3N</h4>
                        <div class="sobre-raven-footer">
                            <p>Es tu plataforma confiable para acceder a indicadores técnicos diseñados para diversos mercados financieros.</p>
                            <p>Mantente actualizado sobre las últimas tendencias y oportunidades de inversión.</p> 
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h4>Explora</h4>
                        <ul class="secciones-footer">
                            <li><a href="{{ route('home') }}">Inicio</a></li>
                            <li><a href="{{ route('vip') }}">Vip</a></li>
                            <li><a href="{{ route('blog') }}">Blog</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <h4>Únite a nuestra comunidad</h4>
                        <ul class="social-icons">
                            <li><a href="https://discord.gg/6D35Bj4M3v">
                                <img src="{{ asset('twitter.svg') }}" alt="Logo twitter">
                            </a></li>
                            <li><a href="https://twitter.com/L1LO_1">
                                <img src="{{ asset('discord.svg') }}" alt="Logo discord">
                            </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
