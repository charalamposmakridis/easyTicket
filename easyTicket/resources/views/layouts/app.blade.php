<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'easyTicket') }}</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<header>
    <nav>
        <ul>
            <li>
                <a href="{{ route('tickets.index') }}">Tickets</a>
            </li>
            @can('admin')
                <li>
                    <a href="{{ route('categories.index') }}">Categories</a>
                </li>
            @endcan
        </ul>

        <div>
            @auth
                <span>{{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
                <a href="{{ route('profile.edit') }}">Profile</a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            @endauth
        </div>
    </nav>
</header>

<main>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @yield('content')
</main>

</body>
</html>
