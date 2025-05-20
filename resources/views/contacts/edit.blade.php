@extends('layouts.contact')

@section('content')
<div class="container">
    <h2>Redaguoti kontaktą</h2>

    <form method="POST" action="{{ route('contacts.update', $contact->id) }}">
        @csrf
        @method('PUT')

        <div>
            <label>Name:</label>
            <input type="text" name="name" value="{{ old('name', $contact->name) }}" required>
        </div>

        <div>
            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email', $contact->email) }}" required>
        </div>

        <div>
            <label>Phone:</label>
            <input type="text" name="phone" value="{{ old('phone', $contact->phone) }}" required>
        </div>

        <button type="submit">Išsaugoti</button>
    </form>
</div>
@endsection
