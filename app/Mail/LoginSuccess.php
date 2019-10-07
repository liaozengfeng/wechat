<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class LoginSuccess extends Mailable
{
    use Queueable, SerializesModels;

    public $username;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username)
    {
        $this->usernam=$username;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.loginSuccess')->with(['username'=>$this->username]);
    }
}
