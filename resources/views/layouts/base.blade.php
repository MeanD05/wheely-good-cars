<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WheelyGoodCars</title>
    <link rel="stylesheet" href="/css/style.css"> <!-- je basis CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <!-- Header -->
    <header class="header">
        <div class="header-container">
            <h1 class="logo">WheelyGoodCars</h1>

            <nav class="nav">
                <a href="/" class="nav-link">Alle auto's</a>
                <a href="/cars" class="nav-link">Mijn aanbod</a>
                <a href="{{ route('offercar') }}" class="nav-link">Aanbod plaatsen</a>
            </nav>

            <div class="auth-links">
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Log uit</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">Log in</a>
                    <a href="{{ route('register') }}">Registreer</a>
                @endauth
            </div>
        </div>

      <div class="errors">
            @if ($errors->any())
                <div class="errors">
                    <strong>Er zijn fouten opgetreden:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </header>

    <!-- Main content -->
    <main class="main-content">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            © {{ date('Y') }} WheelyGoodCars. All rights reserved.
        </div>
    </footer>

</body>
</html>
