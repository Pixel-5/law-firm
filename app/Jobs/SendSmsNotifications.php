<?php

namespace App\Jobs;

use App\Notifications\CustomerCaseScheduleNotification;

class SendSmsNotifications extends SendNotifications
{

    public $queue = 'sms';
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
        $this->schedule->scheduleable->client->notify(new CustomerCaseScheduleNotification($this->schedule));
    }
}
