<?php

    namespace App\Notifications;

    use Carbon\CarbonImmutable;
    use Gr8Shivam\SmsApi\Notifications\SmsApiMessage;
    use Illuminate\Notifications\Messages\NexmoMessage;

    class CustomerCaseScheduleNotification extends CaseScheduleNotification
    {
        public $queue = 'sms';
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
            return ['nexmo'];
        }

        //SmsApiChannel::class

        public function toSmsApi($notifiable)
        {
            return (new SmsApiMessage)
                ->content("content")
                ->params([
                    'phone_number'=>$this->schedule->schedule->scheduleable->client->clientable->cell
                ])
                ;
        }
        public function toNexmo($notifiable)
        {
            return (new NexmoMessage)
                ->clientReference($this->schedule->scheduleable->client->clientable->name)
                ->content('Dear '. $this->schedule->scheduleable->client->clientable->name. ' '. $this->schedule->scheduleable->client->clientable->surname.
                    "\nThis is a reminder that your appointment for " . class_basename($this->schedule->scheduleable). ' '.
                $this->schedule->scheduleable->number. ' has been scheduled ' .
                    CarbonImmutable::parse($this->schedule->start_time)->calendar().
                    ' at '. $this->schedule->venue
                );
        }
    }
