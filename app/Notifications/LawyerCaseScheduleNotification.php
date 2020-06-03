<?php

namespace App\Notifications;

class LawyerCaseScheduleNotification extends CaseScheduleNotification
{

    /**
     * Create a new notification instance.
     *
     * @param $schedule
     */
    public function __construct($schedule)
    {
        parent::__construct($schedule);
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
}
