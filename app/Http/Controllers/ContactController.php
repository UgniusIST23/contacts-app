<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

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

        Contact::create($request->only('name', 'email', 'phone'));

        return redirect()->route('contacts.index')->with('success', 'Contact added successfully!');
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

        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully!');
    }

    // DELETE
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully!');
    }
}
