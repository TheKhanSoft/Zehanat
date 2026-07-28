<?php

namespace App\Mail;

use App\Data\RenderedEmail;
use App\Enums\EmailTemplateKey;
use App\Services\EmailTemplateRenderer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ManagedTemplateMail extends Mailable
{
    use Queueable, SerializesModels;

    private ?RenderedEmail $renderedEmail = null;

    /**
     * @param  array<string, mixed>  $variables
     */
    public function __construct(
        public EmailTemplateKey|string $templateKey,
        public array $variables = [],
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: $this->rendered()->subject);
    }

    public function content(): Content
    {
        return new Content(
            htmlString: $this->rendered()->html,
            text: 'emails.managed-text',
            with: ['content' => $this->rendered()->text],
        );
    }

    private function rendered(): RenderedEmail
    {
        return $this->renderedEmail ??= app(EmailTemplateRenderer::class)
            ->render($this->templateKey, $this->variables);
    }
}
