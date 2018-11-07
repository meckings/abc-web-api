<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $d= 'hello';
    public $message = 'testing';

    /**
     * Create a new message instance.
     *
     * @param $d
     * @param $message
     */
    public function __construct($d, $message)
    {
        $this->d = $d;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('me@work.com', 'Mr Worker')
            ->subject('ABC Mail')
            ->markdown('email.update_profile');
    }
}
