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

    public function toMail($notifiable)
    {
        $url = url('/signup/activate/' . $notifiable->activation_token);
        return (new MailMessage)
            ->view()
            ->subject('Confirm your account')
            ->line('Thanks for signup! Please before you begin, you must confirm your account.')
            ->action('Confirm Account', url($url))
            ->line('Thank you for using our application!');
    }
}
