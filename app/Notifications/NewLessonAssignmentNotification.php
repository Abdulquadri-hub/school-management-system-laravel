<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

class NewLessonAssignmentNotification extends Notification
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
                    ->line("A new assignment for the lesson " . $this->enrolled_student->title . " has been added to your class: " . $this->enrolled_student->class)
                    ->action('View lesson assignment', url("/classes/single/" . $this->enrolled_student->classid . "?tab=single-lesson&single_lesson_id=" . $this->enrolled_student->lid . "&tab1=lesson-assignment"))
                    ->line('Thank you for using Laravel School lms!');
                    // 
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable)
    {
        return new DatabaseMessage([
            'message' => "A new assignment for the lesson: " . $this->enrolled_student->title . " has been added to your class: " . $this->enrolled_student->class,
            'link' =>  url("/classes/single/" . $this->enrolled_student->classid . "?tab=single-lesson&single_lesson_id=" . $this->enrolled_student->lid . "&tab1=lesson-assignment"),
        ]);
    }
}
