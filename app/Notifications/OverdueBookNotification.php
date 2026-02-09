<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OverdueBookNotification extends Notification
{
    use Queueable;

    protected $emprunt;

    /**
     * Create a new notification instance.
     */
    public function __construct(\App\Models\Emprunt $emprunt)
    {
        $this->emprunt = $emprunt;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Overdue Book Reminder: ' . $this->emprunt->livre->titre)
                    ->greeting('Hello ' . $notifiable->name . ',')
                    ->line('This is a reminder that the following book is overdue:')
                    ->line('**Book Title:** ' . $this->emprunt->livre->titre)
                    ->line('**Author:** ' . $this->emprunt->livre->auteur)
                    ->line('**Due Date:** ' . $this->emprunt->date_retour_prevue->format('M d, Y'))
                    ->action('View Your Loans', url('/emprunts'))
                    ->line('Please return the book as soon as possible to avoid further charges.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'emprunt_id' => $this->emprunt->id,
            'livre_id' => $this->emprunt->livre->id,
            'livre_titre' => $this->emprunt->livre->titre,
            'due_date' => $this->emprunt->date_retour_prevue->format('Y-m-d'),
        ];
    }
}
