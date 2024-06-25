<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') :: Panel de Administración de RAV3N</title>
    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/styles.css') }}">
</head>
<body>
    <div id="app">
        <div class="navbar navbar-expand-lg bg-body-tertiary">
        </div>
        <main class="container py-3">
            <div class="row">
                <div class="col-3">
                    <ul>
                        <li>
                            <a class="nav-link" href="{{ route('admin.blog.index') }}">Administración de los tutoriales</a>
                        </li>
                        <li>
                            <a class="nav-link" href="{{ route('home') }}">Volver a la Home</a>
                        </li>
                    </ul>    
                </div>
                <div class="col-9">
                    @yield('content')
                </div>
            </div>
        </main>
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Sobre RAV3N</h4>
                        <p>RAV3N es tu fuente confiable para noticias, análisis y consejos sobre criptomonedas. Mantente actualizado sobre las últimas tendencias en el mundo de las finanzas digitales y las oportunidades de inversión.</p>
                    </div>
                    <div class="col-md-3">
                        <h4>Enlaces</h4>
                        <ul>
                            <li><a href="/">Inicio</a></li>
                            <li><a href="/noticias">Noticias</a></li>
                            <li><a href="/analisis">Análisis</a></li>
                            <li><a href="/inversiones">Inversiones</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <h4>Síguenos en las Redes Sociales</h4>
                        <ul class="social-icons">
                            <li><a href="#" class="facebook"><i class="fab fa-facebook"></i></a></li>
                            <li><a href="#" class="twitter"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#" class="linkedin"><i class="fab fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
