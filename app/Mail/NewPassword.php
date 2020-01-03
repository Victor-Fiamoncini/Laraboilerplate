<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * User that requests reset password
     *
     * @var \App\User
     */
    private $user;

    /**
     * New user password
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
            ->subject('Laraboilerplate - Your new password')
            ->view('mail.new-password')
            ->with([
                'user' => $this->user,
                'password' => $this->password
            ]);
    }
}
