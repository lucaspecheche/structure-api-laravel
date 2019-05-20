<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SignupActivate extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($user)
    {
        $url = url('/signup/activate/' . $user->code);
        return (new MailMessage)
            ->subject('Confirme sua conta')
            ->line('Obrigado por se cadastrar! Por favor, antes de começar, você deve confirmar sua conta.')
            ->action('Confirmar Conta', url($url))
            ->line('Obrigado por usar nosso aplicativo!');
    }
}
