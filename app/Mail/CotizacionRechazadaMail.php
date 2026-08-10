<?php

namespace App\Mail;

use App\Models\Cotizacion;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CotizacionRechazadaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $cotizacion;

    public function __construct(Cotizacion $cotizacion)
    {
        $this->cotizacion = $cotizacion;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Estatus de tu Cotización - Logística MX',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.cotizacion_rechazada',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
