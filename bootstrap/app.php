<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Personalizamos la URL a la que redireccionamos al usuario
        // si no está autenticado.
        // $middleware->redirectGuestsTo('/iniciar-sesion');

        // No venimos realmente usando las URLs, sino que estamos
        // trabajando con los nombres de las rutas.
        // Es raro que esta sea una excepción, así que vamos a
        // cambiarlo para que redireccione a la ruta con el nombre
        // 'auth.login.form'.
        // $middleware->redirectGuestsTo(route('auth.login.form'));

        // Lo anterior va a tirar un error "común" de php, sin la
        // pantalla de error a la que Laravel nos tiene acostumbrados.
        // Esto se debe a que este código está ejecutándose antes de
        // que se termine de crear la aplicación de Laravel, y por
        // lo tanto, muchos de sus sistemas internos no están listos.
        // En este caso, el acceso a las rutas por su nombre no está
        // listo, por lo que tira un error. Y como el sistema de
        // renderizado especial de errores de Laravel tampoco está
        // listo, nos lo tira como un error común.
        //
        // Para resolverlo, podemos seguir el ejemplo de la documentación
        // que en vez de pasar un string a redirectGuestsTo, le pasamos
        // un callback que redireccione a la ruta.
        // $middleware->redirectGuestsTo(fn() => route('auth.login.form'));
        $middleware->redirectGuestsTo(function(Request $request) {
            // $request->session()->flash('feedback.message', 'Para acceder a esta pantalla es necesario haber iniciado sesión.');
            // $request->session()->flash('feedback.type', 'danger');
            session()->flash('feedback.message', 'Para acceder a esta pantalla es necesario haber iniciado sesión.');
            session()->flash('feedback.type', 'danger');
            return route('auth.login.form');
        });

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
