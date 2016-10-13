<?php

namespace Simon\User\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Simon\Mail\Services\Interfaces\MailViewInterface;
use Simon\Mail\Services\Traits\MailView;
use Simon\User\Models\User;

class RegisterMail extends Mailable implements MailViewInterface
{
    use Queueable, SerializesModels,MailView;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $user = null;

    public $hash = '';

    public function __construct(User $User,string $hash)
    {
        //
        $this->user = $User;
        $this->hash = $hash;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('user::emails.register');
    }

}
