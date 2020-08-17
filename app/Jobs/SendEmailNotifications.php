<?php

namespace App\Jobs;

use App\Notifications\LawyerCaseScheduleNotification;

class SendEmailNotifications extends SendNotifications
{
    public $queue = 'email';
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($schedule)
    {
        parent::__construct($schedule);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->schedule->case->user->notify(new LawyerCaseScheduleNotification($this->schedule));
    }
}
