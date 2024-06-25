<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CryptoPostsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MailLoginController;
use App\Http\Controllers\MailRegisterController;
use App\Http\Controllers\MailSuscriberController;

// Rutas generales
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/vip', [HomeController::class, 'vip'])->name('vip');
Route::get('/blog', [CryptoPostsController::class, 'blog'])->name('blog');

// Rutas de autenticación
Route::get('/iniciar-sesion', [AuthController::class, 'loginForm'])->name('auth.login.form');
Route::post('/iniciar-sesion', [AuthController::class, 'loginProcess'])->name('auth.login.process');
Route::post('/cerrar-sesion', [AuthController::class, 'logoutProcess'])->name('auth.logout.process');
Route::get('/registrarse', [AuthController::class, 'registerForm'])->name('auth.register.form');
Route::post('/registrarse', [AuthController::class, 'registerProcess'])->name('auth.register.process');

// Rutas de los posts
Route::get('/crypto-posts', [CryptoPostsController::class, 'index'])->name('posts.index');
Route::get('/crypto-posts/{id}', [CryptoPostsController::class, 'view'])->name('posts.view');

// Rutas de administración (con middleware auth)
Route::middleware(['auth'])->group(function () {
    Route::get('/posts/crear', [CryptoPostsController::class, 'createForm'])->name('posts.create.form');
    Route::post('/posts/crear', [CryptoPostsController::class, 'createProcess'])->name('posts.create.process');
    Route::get('/posts/{id}/editar', [CryptoPostsController::class, 'editForm'])->name('posts.edit.form');
    Route::post('/posts/{id}/editar', [CryptoPostsController::class, 'editProcess'])->name('posts.edit.process');
    Route::get('/posts/{id}/eliminar', [CryptoPostsController::class, 'deleteForm'])->name('posts.delete.form');
    Route::post('/posts/{id}/eliminar', [CryptoPostsController::class, 'deleteProcess'])->name('posts.delete.process');

    // Ruta para la lista de usuarios
    Route::get('/user/list', [AuthController::class, 'userList'])->name('user.list');
});

// Ruta para previsualización del correo electrónico Login
Route::get('/emails/preview/mail-login', function () {
    return new \App\Mail\Login;
})->name('preview.mail.login');

// Ruta para enviar el correo electrónico de inicio de sesión
Route::get('/send-login-email', [MailLoginController::class, 'sendLoginEmail'])->name('send.login.email');

// Ruta para previsualización del correo electrónico Register
Route::get('/emails/preview/mail-register', function () {
    return new \App\Mail\Register;
})->name('preview.mail.register');

// Ruta para enviar el correo electrónico de registro
Route::get('/send-register-email', [MailRegisterController::class, 'sendRegisterEmail'])->name('send.register.email');

// Ruta para previsualización del correo electrónico Suscriber
Route::get('/emails/preview/mail-suscriber', function () {
    return new \App\Mail\Suscriber;
})->name('preview.mail.suscriber');

// Ruta para enviar el correo electrónico de suscripción
Route::get('/send-suscriber-email', [MailSuscriberController::class, 'sendSuscriberEmail'])->name('send.suscriber.email');
