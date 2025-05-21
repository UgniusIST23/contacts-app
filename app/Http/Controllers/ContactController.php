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

    // DELETE (Soft Delete)
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully!');
    }

    // TRASHED VIEW
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

        return redirect()->route('contacts.index')->with('success', 'Contact restored!');
    }

    // PERMANENT DELETE
    public function forceDelete($id)
    {
        $contact = Contact::withTrashed()->findOrFail($id);
        $contact->forceDelete();

        return redirect()->route('contacts.trashed')->with('success', 'Contact permanently deleted!');
    }
}
