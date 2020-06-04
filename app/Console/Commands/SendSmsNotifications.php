<?php

namespace App\Console\Commands;

use App\Facade\ScheduleRepository;
use App\Jobs\SendEmailNotifications;
use App\Jobs\SendSmsNotifications as SendSmsNotificationsJob;
use App\Notifications\CustomerCaseScheduleNotification;
use App\Notifications\LawyerCaseScheduleNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class SendSmsNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:sms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'sending sms reminder to clients & lawyers about their case schedule';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $schedules = ScheduleRepository::schedules();
        foreach ($schedules as $schedule){
            $days = $schedule->start_time->diffInDays(Carbon::now()->addDays(2));
            if ($days === 0) {
                //$schedule->case->file->notify(new CustomerCaseScheduleNotification);
                SendEmailNotifications::dispatch($schedule)->onQueue('email');
                SendSmsNotificationsJob::dispatch($schedule)->onQueue('sms');

                echo "case to schedule is " . $schedule->start_time . " days " . $days . "\n";
                echo "client to notify " . $schedule->case->file->contact. "\n";
                echo "Lawyer to notify " . $schedule->case->user->name. "\n";
            }
        }

    }
}
