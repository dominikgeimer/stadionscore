<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\URL;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class TeamInvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
{
    return new Envelope(
        subject: 'Invitation to join ' . config('app.name'),
    );
}

public function content(): Content
{
    return new Content(
        view: 'view.name',
        markdown: 'emails.team-invitation',
        with: [
            'acceptUrl' => URL::signedRoute(
                "invitation.accept",
                ['invitation' => $this->user]
            ),
        ]
    );
}
}
