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
                <a href="{{ route('home') }}" class="nav-link">Alle auto's</a>
                <a href="{{ route('cars.mycars') }}" class="nav-link">Mijn aangeboden auto's</a>
                <a href="{{ route('offercar') }}" class="nav-link">Aanbod plaatsen</a>
            </nav>

            <div class="auth-links">
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Log uit</button>
                    </form>
                    <p class="ml-4">Ingelogd als: {{ Auth::user()->name }}</p>

                @else
                    <a href="{{ route('login') }}">Log in</a>
                    <a href="{{ route('register') }}">Registreer</a>
                @endauth
            </div>
        </div>
        

        


    </header>


    <!-- Main content -->
    <main class="main-content">
        <div class="messages">
        @if (session('success'))
            <div class="p-3 mb-3 rounded bg-green-100 text-green-800 border border-green-200">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="p-3 mb-3 rounded bg-red-100 text-red-800 border border-red-200">
                {{ session('error') }}
            </div>
        @endif

        @if (session('status'))
            <div class="p-3 mb-3 rounded bg-blue-100 text-blue-800 border border-blue-200">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="p-3 mb-3 rounded bg-red-100 text-red-800 border border-red-200">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        </div>
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
