<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Welcome extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * New registered user
     *
     * @var \App\User
     */
    private $user;

    /**
     * Raw user password registered
     *
     * @var string
     */
    private $password;

    /**
     * Create a new message instance.
     *
     * @param \App\User $user
     * @param string $password
     * @return void
     */
    public function __construct(User $user, string $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from($this->user->email)
            ->subject('Welcome to Laraboilerplate!')
            ->view('mail.welcome')
            ->with([
                'user' => $this->user,
                'password' => $this->password
            ]);
    }
}
