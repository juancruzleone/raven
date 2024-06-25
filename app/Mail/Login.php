<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Login extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct()
    {
        //
    }

    public function build()
    {
        return $this->subject('Inicio de sesión en tu cuenta')
                    ->from('no-responder@rav3n.com', 'Rav3n indicators')
                    ->view('emails.mail-login')
                    ->with([
                        'logo' => asset('logo-rav3n.svg'),
                    ]);
    }
}
