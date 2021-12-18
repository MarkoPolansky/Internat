<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActivitySelected extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $activities;
    public $subject;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($activities)
    {
        $this->activities = collect($activities);
        $this->subject = collect($this->activities
                ->get('availableActivities'))->pluck('name')->implode(' ')
            . ' ' . $this->activities->get('starts_at')
            . ' - ' . $this->activities->get('ends_at');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
            ->markdown('emails.activities.index')->with([
            'activities' => $this->activities
        ]);
    }
}
