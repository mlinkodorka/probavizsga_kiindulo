<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Szakdolgozat2022</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" 
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" 
            crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/ajax.js') }}"></script>
    <script src="{{ asset('js/szakdoga.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</head>

<body class="antialiased bg-light">

    <main>
        <header class="py-4 bg-primary text-white text-center">
            <h1 class="display-6">Számalk-Szalézi technikum és Szakgimnázium 2020-2022 évfolyam szoftverfejlesztőinek szakdolgozatai</h1>
        </header>

        <section class="bejelentkezes text-center mt-5">
            <h2 class="mb-4">A szakdolgozatokat bejelentkezés után tudja megnézni!</h2>
            @if (Route::has('login'))
            <div class="d-inline-block">
                @auth
                <a href="{{ url('/dashboard') }}" class="btn btn-success btn-lg me-2">Szakdolgozatok</a>
                @else
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg me-2">Bejelentkezés</a>
                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn btn-secondary btn-lg">Regisztráció</a>
                @endif
                @endauth
            </div>
            @endif
        </section>

        <article class="container my-5">
            <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla facilisi. Proin vel felis eget lacus semper ultrices.</p>
        </article>

        <footer class="text-center py-3 bg-dark text-white">
            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        </footer>
    </main>

</body>

</html>
