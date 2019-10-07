<?php

namespace App\Listeners;

use App\Events\Register;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Register  $event
     * @return void
     */
    public function handle(register $event)
    {
        //
        $this->user=$event->user;
        Mail::send("email.registersuccess",['username'=>$this->user->name],function ($message){
            $message->to($this->user);
            $message->subject($this->subject);
    }
}
