<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReplyAltered extends Mailable
{
    use Queueable, SerializesModels;

    public $modifier;
    public $msg;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $modifier,$msg)
    {
        //
        $this->modifier = $modifier;
        $this->msg = $msg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');
        return $this->view('mail.reply_altered');

    }
}
