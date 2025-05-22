<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{
    // READ
    public function index()
    {
        $contacts = Contact::all();
        return view('contacts.index', compact('contacts'));
    }

    // CREATE
    public function create()
    {
        return view('contacts.create');
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
        ]);

        $contact = Contact::create($request->only('name', 'email', 'phone'));

        // MAIL upon create
        $formData = $request->only('name', 'email', 'phone');
        Mail::to('test@example.com')->send(new ContactFormMail($formData));

        return redirect()->route('contacts.index')->with('success', 'Kontaktas pridėtas ir laiškas išsiųstas!');
    }

    // EDIT
    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    // UPDATE
    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
        ]);

        $contact->update($request->only('name', 'email', 'phone'));

        return redirect()->route('contacts.index')->with('success', 'Kontaktas atnaujintas!');
    }

    // DELETE (Soft Delete)
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('contacts.index')->with('success', 'Kontaktas ištrintas!');
    }

    // TRASHED LIST
    public function trashed()
    {
        $contacts = Contact::onlyTrashed()->get();
        return view('contacts.trashed', compact('contacts'));
    }

    // RESTORE
    public function restore($id)
    {
        $contact = Contact::withTrashed()->findOrFail($id);
        $contact->restore();
        return redirect()->route('contacts.index')->with('success', 'Kontaktas atstatytas!');
    }

    // PERMANENT DELETE
    public function forceDelete($id)
    {
        $contact = Contact::withTrashed()->findOrFail($id);
        $contact->forceDelete();
        return redirect()->route('contacts.trashed')->with('success', 'Kontaktas ištrintas visam laikui!');
    }

    // SEND EMAIL
    public function sendEmail(Contact $contact)
    {
        $formData = [
            'name' => $contact->name,
            'email' => $contact->email,
            'phone' => $contact->phone,
        ];

        Mail::to($contact->email)->send(new ContactFormMail($formData));

        return redirect()->route('contacts.index')->with('success', 'Laiškas išsiųstas kontaktui!');
    }
}
