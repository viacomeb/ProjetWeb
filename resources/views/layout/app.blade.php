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

            <!-- Navigation Links -->
            <div class="nav-links">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Accueil</a>
                <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">À propos</a>
                <a href="{{ route('careers') }}" class="nav-link {{ request()->routeIs('careers') ? 'active' : '' }}">Carrières</a>
                <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>

                <!-- Mobile Auth Buttons -->
                <div class="mobile-auth-buttons">
                    @if (Auth::check())
                    <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();" class="btn btn-primary">
                        Déconnexion
                    </a>
                    @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Se connecter</a>
                    @endif
                </div>
            </div>

            <!-- Desktop Auth Buttons -->
            <div class="auth-buttons">
                @if (Auth::check())
                <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();" class="btn btn-primary">
                    Déconnexion
                </a>
                @else
                <a href="{{ route('login') }}" class="btn btn-primary">Se connecter</a>
                @endif
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
        <br />
        <br />
        <br />
        <br />
        @yield('content')
        <br />
        <br />
        <br />
        <br />
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
                        <li><a href="{{ route('careers') }}">Carrières</a></li>
                    </ul>
                </div>
                <!-- Section "Ressources" -->
                <div class="footer-section">
                    <h3>Ressources</h3>
                    <ul>
                        <li><a href="{{ route('guide') }}">Guide</a></li>
                        <li><a href="{{ route('support') }}">Support</a></li>
                    </ul>
                </div>
                <!-- Section "Légal" -->
                <div class="footer-section">
                    <h3>Légal</h3>
                    <ul>
                        <li><a href="{{ route('legal') }}">Mentions légales</a></li>
                        <li><a href="{{ route('cgu') }}">CGU</a></li>
                        <li><a href="{{ route('privacy') }}">Confidentialité</a></li>
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
    @vite(['resources/js/app.js'])
</body>

</html>
