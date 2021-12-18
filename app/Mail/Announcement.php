<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Announcement extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $announcement;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(\App\Models\Announcement $announcement)
    {
        $this->announcement = $announcement;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->announcement->title)
                    ->markdown('emails/announcements/index')->with([
            'announcement' => $this->announcement
        ]);
    }
}
