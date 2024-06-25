<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\CryptoUser;
use App\Models\Role;
use App\Mail\Login;
use App\Mail\Register;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function loginProcess(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'El campo de correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección de correo electrónico válida.',
            'password.required' => 'El campo de contraseña es obligatorio.',
        ]);

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return redirect()
                ->route('auth.login.form')
                ->withInput()
                ->withErrors(['login' => 'Las credenciales ingresadas no coinciden con nuestros registros.'])
                ->with('status', 'Las credenciales ingresadas no coinciden con nuestros registros.')
                ->with('alert-class', 'alert-danger'); // Añadir esto para especificar la clase de alerta
        }

        // Enviar correo electrónico de inicio de sesión
        Mail::to(auth()->user()->email)->send(new Login());

        // Redireccionar al home después de un inicio de sesión exitoso
        return redirect()
            ->route('home')
            ->with('status', '¡Bienvenido de nuevo ' . auth()->user()->name . '!')
            ->with('alert-class', 'alert-success'); // Añadir esto para especificar la clase de alerta
    }

    public function logoutProcess(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('auth.login.form')
            ->with('status', 'La sesión se cerró correctamente. ¡Te esperamos de nuevo pronto!')
            ->with('alert-class', 'alert-success'); // Añadir esto para especificar la clase de alerta
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function registerProcess(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:4', 
            'email' => 'required|email|unique:crypto_users',
            'password' => 'required|string|min:8',
        ], [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.string' => 'El nombre debe ser un texto válido.',
            'name.min' => 'El nombre debe tener al menos :min caracteres.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.required' => 'El campo de contraseña es obligatorio.',
            'email.required' => 'El campo de correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección de correo válida.',
            'email.unique' => 'La cuenta de correo electrónico ya existe.',
        ]);
    
        $user = CryptoUser::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);
    
        Auth::login($user);

        // Enviar correo electrónico de registro
        Mail::to($user->email)->send(new Register());
    
        // Redireccionar al home después de un registro exitoso
        return redirect()
            ->route('home')
            ->with('status', '¡Bienvenido ' . $user->name . '! Tu cuenta ha sido creada exitosamente.')
            ->with('alert-class', 'alert-success'); // Añadir esto para especificar la clase de alerta
    }
    
    public function userList()
    {
        // Verifica que el usuario esté autenticado
        if (auth()->check()) {
            // Obtener solo los usuarios con el rol 'subscripto'
            $users = CryptoUser::whereHas('roles', function ($query) {
                $query->where('name', 'subscripto');
            })->get();

            return view('user.list', compact('users'));
        }

        // Si no está autenticado, redirige a la página de inicio de sesión
        return redirect()->route('auth.login.form')->with('status', 'Debes iniciar sesión para ver la lista de usuarios.');
    }
}
