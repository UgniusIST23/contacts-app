@extends('layouts.contact')

@section('content')
<div class="container">
    <h2>Kontaktų sąrašas</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3 d-flex flex-wrap gap-2">
        <a href="{{ route('contacts.create') }}" class="btn btn-success">Pridėti kontaktą</a>
        <a href="{{ route('contacts.trashed') }}" class="btn btn-secondary">Ištrinti kontaktai</a>
        <a href="{{ url('/generate-pdf') }}" class="btn btn-outline-dark">Atsisiųsti PDF</a>
        <a href="{{ route('pdf.send') }}" class="btn btn-outline-info">Siųsti PDF</a>
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
                            <div class="d-flex gap-1 flex-wrap">
                                <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-primary btn-sm">
                                    Redaguoti
                                </a>

                                <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Ištrinti</button>
                                </form>

                                <form action="{{ route('contacts.sendEmail', $contact->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-info btn-sm">Siųsti el. laišką</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
