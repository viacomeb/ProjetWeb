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

    </head>
    <header class="header">
        <nav class="container">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="logo-link">
                <div class="logo">
                    <img src="{{ asset('images/WorknGo_logo3.svg') }}" alt="Logo" class="logo-icon"
                        style="width: 60px; height: auto;">
                    <span>WorknGo</span>
                </div>
            </a>

            <!-- Liens de navigation -->
            <div class="nav-links">
                <a href="{{ route('home') }}" class="nav-link">Accueil</a>
                <a href="{{ route('offres.liste') }}" class="nav-link">Offres</a>
                <a href="{{ route('entreprises.liste') }}" class="nav-link">Entreprises</a>
                <a href="{{ route('contact') }}" class="nav-link">Contact</a>
            </div>

            <!-- Boutons d'authentification -->
            <div class="auth-buttons">
                <button onclick="window.location.href='{{ route('auth.connexion') }}'" class="btn btn-text">Se
                    connecter</button>
                <button onclick="window.location.href='{{ route('auth.inscription') }}'" class="btn btn-primary">Créer
                    un compte</button>
            </div>

            <!-- Bouton pour le menu mobile -->
            <button class="mobile-menu-btn" aria-label="Menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </nav>
    </header>

    <!-- MAIN CONTENT -->
    <main>
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <!-- Section "À propos" -->
                <div class="footer-section">
                    <h3>À propos</h3>
                    <ul>
                        <li><a href="{{ route('about') }}">Qui sommes-nous</a></li>
                        <li><a href="{{ route('blog') }}">Blog</a></li>
                        <li><a href="{{ route('carrieres') }}">Carrières</a></li>
                    </ul>
                </div>
                <!-- Section "Ressources" -->
                <div class="footer-section">
                    <h3>Ressources</h3>
                    <ul>
                        <li><a href="#">Guide</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Support</a></li>
                    </ul>
                </div>
                <!-- Section "Légal" -->
                <div class="footer-section">
                    <h3>Légal</h3>
                    <ul>
                        <li><a href="#">Mentions légales</a></li>
                        <li><a href="#">CGU</a></li>
                        <li><a href="#">Confidentialité</a></li>
                    </ul>
                </div>
                <!-- Section "Suivez-nous" -->
                <div class="footer-section">
                    <h3>Suivez-nous</h3>
                    <ul>
                        <li><a href="#">LinkedIn</a></li>
                        <li><a href="#">Twitter</a></li>
                        <li><a href="#">Instagram</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <!-- Affichage dynamique de l'année en cours -->
                <p>&copy; {{ date('Y') }} WorknGo. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    @vite('resources/js/app.js')

</body>

</html>
