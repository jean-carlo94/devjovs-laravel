<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCandidate extends Notification
{
    use Queueable;
    public int $id_vacancy;
    public string $name_vacancy;
    public int $user_id;

    /**
     * Create a new notification instance.
     */
    public function __construct(int $id_vacancy, string $name_vacancy, int $user_id)
    {
        $this->id_vacancy = $id_vacancy;
        $this->name_vacancy = $name_vacancy;
        $this->user_id = $user_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = url('/notifications');

        return (new MailMessage)
                    ->line('Has recibido un nuevo candidato en tu vacante')
                    ->line('La vacante es: ' . $this->name_vacancy)
                    ->action('Ver Notificaciones', $url)
                    ->line('Gracias por utilizar DevJobs!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    public function toDatabase($notifiable){
        return [
            'id_vacancy' => $this->id_vacancy,
            'name_vacancy' => $this->name_vacancy,
            'user_id' => $this->user_id,
        ];
    }
}
