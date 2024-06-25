<?php

namespace App\Http\Controllers;

use App\Mail\Suscriber;
use Illuminate\Support\Facades\Mail;

class MailSuscriberController extends Controller
{
    public function sendSuscriberEmail()
    {
        Mail::to(auth()->user()->email)->send(new Suscriber());

        return redirect()->route('dashboard')->with('success', 'Correo de suscripción enviado correctamente.');
    }
}
