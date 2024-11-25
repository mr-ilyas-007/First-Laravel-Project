<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CronJobMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $messageContent;
    protected $subjectContent;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($messageContent, $subjectContent)
    {
        $this->messageContent = $messageContent;
        $this->subjectContent = $subjectContent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.cronjob-mail')->with(['Message'=> $this->messageContent, 'Subject'=> $this->subjectContent]);
    }
}
