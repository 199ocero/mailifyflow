<?php

namespace App\Mail;

use App\Models\Campaign;
use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Blade;

class CampaignMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public Campaign $campaign, public Subscriber $subscriber)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->campaign->subject,
            from: new Address(address: $this->campaign->from_email, name: $this->campaign->from_name),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $renderedContent = Blade::render($this->campaign->converted_content, [
            'subscriber_first_name' => $this->subscriber->first_name ?? null,
            'subscriber_last_name' => $this->subscriber->last_name ?? null,
            'subscriber_email' => $this->subscriber->email,
        ]);

        return new Content(
            htmlString: $renderedContent
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
