<?php

namespace App\Console\Commands;

use App\Facade\FileRepository;
use App\Facade\ScheduleRepository;
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
    protected $description = 'Command description';

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
            $days = Carbon::now()->diffInDays($schedule->start_time);
            if ($days === 2) {
                echo "case to schedule is " . $schedule->start_time . " days " . $days . "\n";
                echo "client to notify " . $schedule->case->file->contact. "\n";
                echo "Lawyer to notify " . $schedule->case->user->email. "\n";
            }
        }

    }
}
