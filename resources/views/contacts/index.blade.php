@extends('layouts.contact')

@section('content')
<div class="container">
    <h2>Kontaktų sąrašas</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3">
        <a href="{{ route('contacts.create') }}" class="btn btn-success">Pridėti kontaktą</a>
        <a href="{{ route('contacts.trashed') }}" class="btn btn-secondary ms-2">Ištrinti kontaktai</a>
    </div>

    @if($contacts->isEmpty())
        <p>Kontaktų nėra.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Vardas</th>
                    <th>El. paštas</th>
                    <th>Telefonas</th>
                    <th>Veiksmai</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contacts as $contact)
                    <tr>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->phone }}</td>
                        <td>
                            <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-primary btn-sm">Redaguoti</a>

                            <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Ištrinti</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
