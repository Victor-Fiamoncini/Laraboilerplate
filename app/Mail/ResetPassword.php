<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * User that requests reset password
     *
     * @var \App\User
     */
    private $user;

    /**
     * Reset password confirmation token
     *
     * @var string
     */
    private $token;

    /**
     * Create a new message instance.
     *
     * @param \App\User $user
     * @param string $token
     * @return void
     */
    public function __construct(User $user, string $token)
    {
        $this->user = $user;
        $this->token = $token;
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
            ->subject('Laraboilerplate - Reset your password')
            ->view('mail.reset-password')
            ->with([
                'user' => $this->user,
                'token' => $this->token
            ]);
    }
}
