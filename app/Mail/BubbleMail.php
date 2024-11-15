<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Session;
use Illuminate\Mail\Mailables\Address;

class BubbleMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    public $email;
    public $code;
    public $name;
    public $message;

    public function __construct($email,$name,$message)
    {
        $this->email = $email;
        $this->name = $name;
        $this->code = rand(100000,999999);
        $this->message = $message;
        Session::put([
            'code' => $this->code,
            'code_created_at' => now(),
        ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->message,
            from: new Address('manhnguyenn23077@gmail.com','Your Delicious Bubble Tea'),
            to: $this->email
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.index',
            with: [
                'code' => $this->code,
                'name' => $this->name,
                'message' => $this->message,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
