@extends('layouts.contact')

@section('content')
<div class="container">
    <h2>Kontaktų sąrašas</h2>

    @if(session('success'))
        <div style="color: green">{{ session('success') }}</div>
    @endif

    <a href="{{ route('contacts.create') }}" class="btn btn-success">Pridėti kontaktą</a>

    <ul>
        @foreach($contacts as $contact)
            <li>
                {{ $contact->name }} – {{ $contact->email }} – {{ $contact->phone }}

                <a href="{{ route('contacts.edit', $contact->id) }}">📝</a>

                <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">🗑️</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>
@endsection
