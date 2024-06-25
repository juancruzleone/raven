<?php

namespace App\Http\Controllers;

use App\Mail\Register;
use Illuminate\Support\Facades\Mail;

class MailRegisterController extends Controller
{
    public function sendRegisterEmail()
    {
        Mail::to(auth()->user()->email)->send(new Register());

        return redirect()->route('dashboard')->with('success', 'Correo de registro enviado correctamente.');
    }
}
