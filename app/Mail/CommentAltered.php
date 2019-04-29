<?php

namespace App\Mail;

use App\User;
use App\Agrolytic;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CommentAltered extends Mailable
{
    use Queueable, SerializesModels;

    public $opRep;
    public $lineManager;

    public $modifier;
    public $op_rep;
    public $agrolytic;
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
        // $this->op_rep = $op_rep;
        $this->msg = $msg;
        // $this->agrolytic = $agrolytic;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.comment_altered');
    }

    
}
