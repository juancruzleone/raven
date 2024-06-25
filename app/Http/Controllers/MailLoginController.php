<?php

namespace App\Http\Controllers;

use App\Mail\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailLoginController extends Controller
{
    public function sendLoginEmail(Request $request)
    {
        // Envía el correo electrónico de inicio de sesión al usuario autenticado
        Mail::to(auth()->user()->email)->send(new Login());

        return redirect()->route('home')->with('success', 'Correo de inicio de sesión enviado.');
    }
}
