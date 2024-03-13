<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

class NewLessonNotification extends Notification
{
    use Queueable;

    public $enrolled_student;

    /**
     * Create a new notification instance.
     */
    public function __construct($enrolled_student)
    {
        //
        $this->enrolled_student = $enrolled_student;
        
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
        return (new MailMessage)
                    ->greeting("Hello!" . " " . $this->enrolled_student->firstname . " " . $this->enrolled_student->lastname)
                    ->line("A new lesson has been added to your class!")
                    ->action('View Class', url("/classes/single/" . $this->enrolled_student->classid . "?tab=lessons"))
                    ->line('Thank you for using School Laravel!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable)
    {
        return new DatabaseMessage([
            'message' => 'A new lesson has been added to your class!',
            'link' =>  url("/classes/single/" . $this->enrolled_student->classid . "?tab=lessons"),
        ]);
    }
}
