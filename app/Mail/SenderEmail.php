<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * @property public subject
 * @property private $user
 */
class SenderEmail extends Mailable
{
    use Queueable, SerializesModels;

    private User $user;

    /**
     * Create a new message instance.
     * @param User $user
     * @param string $subject
     * @return void
     */
    public function __construct(User $user , string $subject)
    {
        $this->user = $user;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to("falcon.9roc@gmail.com")
            ->view("welcome")
            ->subject($this->subject);
    }
}
