<?php

namespace App\Notifications;

use App\Models\Enrollment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EnrollmentNotification extends Notification
{
    use Queueable;

    public $enrollment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($enrollment)
    {
        $this->enrollment = $enrollment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $approval = strtolower($this->enrollment->approval);

        return [
            'url' => route('users.enrollments.show', $this->enrollment),
            'icon' => 'user-graduate',
            'title' => "Curso $approval",
            'id' => $this->enrollment->id,
            'name' => $this->enrollment->course->name,
            'time' => now()->diffForHumans(),
        ];
    }
}
