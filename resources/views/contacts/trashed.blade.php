@extends('layouts.contact')

@section('content')
    <div class="container">
        <h2>Ištrinti kontaktai</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('contacts.index') }}" class="btn btn-primary mb-3">Grįžti į kontaktų sąrašą</a>

        @if($contacts->isEmpty())
            <div class="alert alert-info">Jokių ištrintų kontaktų nerasta.</div>
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
                                <form action="{{ route('contacts.restore', $contact->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-warning btn-sm">Atstatyti</button>
                                </form>

                                <form action="{{ route('contacts.forceDelete', $contact->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Ar tikrai ištrinti visam laikui?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Trinti visam laikui</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
