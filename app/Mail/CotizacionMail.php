<?php

namespace App\Mail;

use App\Models\Cotizacion;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class CotizacionMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Cotizacion $cotizacion) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nueva Cotización #' . str_pad($this->cotizacion->id, 5, '0', STR_PAD_LEFT) . ' — ' . $this->cotizacion->cliente_nombre,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.cotizacion',
            with: ['cotizacion' => $this->cotizacion],
        );
    }

    public function attachments(): array
    {
        return [
            // Metemos la generación del PDF directo en la función constructora del adjunto
            Attachment::fromData(
                fn () => Pdf::loadView('pdf.cotizacion', ['cotizacion' => $this->cotizacion])->output(),
                'Cotizacion-' . str_pad($this->cotizacion->id, 5, '0', STR_PAD_LEFT) . '.pdf'
            )->withMime('application/pdf'),
        ];
    }
}
