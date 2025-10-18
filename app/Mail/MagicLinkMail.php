<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class MagicLinkMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $magicLink; // <- public sehingga blade bisa mengakses $magicLink

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, string $magicLink)
    {
        $this->user = $user;
        $this->magicLink = $magicLink;
    }

    /**
     * Build the message.
     */
   public function build()
{
    return $this
        ->subject('Login Magic Link — ' . config('app.name'))
        ->markdown('mail.magic_link') // pakai markdown, bukan view()
        ->with([
            'user' => $this->user,
            'magicLink' => $this->magicLink,
        ]);
}

}
