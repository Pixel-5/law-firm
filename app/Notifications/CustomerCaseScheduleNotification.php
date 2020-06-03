<?php

    namespace App\Notifications;

    use Gr8Shivam\SmsApi\Notifications\SmsApiChannel;
    use Gr8Shivam\SmsApi\Notifications\SmsApiMessage;
    use Illuminate\Notifications\Messages\NexmoMessage;

    class CustomerCaseScheduleNotification extends CaseScheduleNotification
    {
        /**
         * Create a new notification instance.
         *
         * @return void
         */
        public function __construct()
        {
            parent::__construct();
        }

        /**
         * Get the notification's delivery channels.
         *
         * @param  mixed  $notifiable
         * @return array
         */

        public function via($notifiable)
        {
            return ['nexmo',SmsApiChannel::class];
        }

        public function toSmsApi($notifiable)
        {
            return (new SmsApiMessage)
                ->content("Hello");
        }
        public function toNexmo($notifiable)
        {
            return (new NexmoMessage)
                ->content('Your SMS message content');
        }
    }
