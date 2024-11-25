<?php

namespace App\Console\Commands;

use App\Mail\CronJobMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class IntervalMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will send email per 15 seconds';

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
     * @return int
     */
    public function handle()
    {
        $to = "shaikhilyas28504@gmail.com";
        $message = "Hello Bro! i am sendind this mail to you from Laravel 8 CronJob functionality";
        $subject = "Sending mail with Laravel 8";
        Mail::to($to)->send(new CronJobMail($message, $subject));
    }
}
