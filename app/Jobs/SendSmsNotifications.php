<?php

namespace App\Jobs;

class SendSmsNotifications extends SendNotifications
{

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
        //TODO
        echo "job schedule >> ". $this->schedule->id;
    }
}
