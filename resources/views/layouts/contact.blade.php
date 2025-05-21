<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contacts App</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
    <a class="navbar-brand text-white" href="{{ route('contacts.index') }}">Kontaktai</a>

    <div class="collapse navbar-collapse">
        <ul class="navbar-nav me-auto">
            @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contacts.create') }}">Pridėti kontaktą</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contacts.trashed') }}">Ištrinti kontaktai</a>
                </li>
            @endauth
        </ul>
        <ul class="navbar-nav ms-auto">
            @auth
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm">Atsijungti</button>
                    </form>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('login') }}">Prisijungti</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('register') }}">Registruotis</a>
                </li>
            @endauth
        </ul>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

@livewireScripts

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
