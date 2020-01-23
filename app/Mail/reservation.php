<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class reservation extends Mailable
{
    use Queueable, SerializesModels;

    public $allValues;

    /**
     * Create a new message instance.
     *
     * @return void
     */


    public function __construct(Array $allValues)
    {
        $this->allValues = $allValues;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(getenv("APP_EMAIL"))
                ->view('emails.reservation');
    }
}
