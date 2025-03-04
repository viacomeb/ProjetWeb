<?php
// src/View/layout/header.php
?>

<body>
    <!-- HEADER -->
    <header class="header">
        <nav class="container">
            <!-- Logo -->
            <div class="logo">
                <!-- Exemple de logo en SVG -->
                <img src="../public/assets/images/WorknGo_logo.svg" alt="Logo" class="logo-icon">
                <span>WorknGo</span>
            </div>

            <!-- Liens de navigation -->
            <div class="nav-links">
                <a href="../public/index.php" class="nav-link">Accueil</a>
                <a href="/offres" class="nav-link">Offres</a>
                <a href="/entreprises" class="nav-link">Entreprises</a>
                <a href="/contact" class="nav-link">Contact</a>
            </div>

            <!-- Boutons d'authentification -->
            <div class="auth-buttons">
                <button class="btn btn-text">Se connecter</button>
                <button class="btn btn-primary">Créer un compte</button>
            </div>

            <!-- Bouton pour le menu mobile -->
            <button class="mobile-menu-btn" aria-label="Menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </nav>
    </header>
