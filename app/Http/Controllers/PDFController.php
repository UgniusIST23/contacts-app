<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function generatePDF()
    {
        // Contacts iš DB
        $contacts = Contact::all();

        // VIEW pdf/contacts_list.blade.php
        $pdf = Pdf::loadView('pdf.contacts_list', compact('contacts'));

        // PDF DOWNLOAD
        return $pdf->download('kontaktai.pdf');
    }
}
