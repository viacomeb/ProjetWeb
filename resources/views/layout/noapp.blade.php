<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WorknGo - @yield('title')</title>
    <link rel="icon" href="{{ asset('images/WorknGo_logo.png') }}">

    <!-- Toujours inclure le fichier CSS général -->
    @vite('resources/css/style.css')

    <!-- Emplacement pour les styles spécifiques aux pages -->
    @stack('styles')
</head>


<body>
    <!-- MAIN CONTENT -->
    <main>
        @yield('content')
    </main>

    <!-- Scripts -->
    @vite('resources/js/app.js')

</body>

</html>
