<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Contact;

class ContactsPDFMail extends Mailable
{
    use Queueable, SerializesModels;

    public function build()
    {
        // Contacts iš DB
        $contacts = Contact::all();

        // PDF from blade
        $pdf = Pdf::loadView('pdf.contacts_list', compact('contacts'));

        // SEND MAIL
        return $this->subject('Kontaktų sąrašas PDF formatu')
                    ->view('emails.pdfinfo')
                    ->attachData($pdf->output(), 'kontaktai.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
