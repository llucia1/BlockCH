<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;
    private $userData = '';
    private $data = '';
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userData,$data)
    {
        $this->data = $data;
        $this->userData = $userData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $userData = $this->userData;
        $data = $this->data;
        return $this->from('96b8ceb8ed-a388d6@inbox.mailtrap.io')
                    ->view('mails.confirm_account',compact('userData','data'))
                    ->text('mails.confirm_account_plain');
    }
}
