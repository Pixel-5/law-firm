<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CaseScheduleNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $schedule;

    /**
     * Create a new notification instance.
     *
     * @param $schedule
     */
    public function __construct($schedule)
    {
        $this->schedule = $schedule;
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
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    public function toDatabase()
    {
        return [
            'case_no' => $this->schedule->case->number,
            'start_time' => $this->schedule->start_time,
            'end_time' => $this->schedule->end_time,
            'venue' => $this->schedule->venue,
        ];
    }

    public function toArray()
    {
        return [
            'case_no' => $this->schedule->case->number,
            'start_time' => $this->schedule->start_time,
            'end_time' => $this->schedule->end_time,
            'venue' => $this->schedule->venue,
        ];
    }

}
