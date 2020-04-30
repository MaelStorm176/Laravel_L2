<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomResetPasswordNotification extends Notification
{
    use Queueable;

    protected $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  string  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $link = url( "/password/reset/" . $this->token );
       return ( new MailMessage )
           ->greeting('Bonjour')
           ->from('pizzeria.l2.reims@gmail.com')
           ->subject( 'Réinitialisation de votre mot de passe' )
           ->line( "Nous avons bien reçu votre demande !" )
           ->line( "Cliquez sur ce bouton afin de mettre à jour votre mot de passe !" )
           ->action( 'Reinitialiser votre mot de passe', $link )
           ->line( 'Merci de nous soutenir !' );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
