<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InviteUser extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    private $invite;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invite)
    {
        $this->invite = $invite;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Pozvánka do systému '.config('app.name'))
            ->markdown('emails/invites/internatista')->with([
                'invite' => $this->invite
            ]);
    }
}
