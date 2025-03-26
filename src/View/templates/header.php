<?php
// src/View/layout/header.php

include_once '../config/security.php'; // Inclure la sécurité

?>
<!-- HEADER -->
<header class="header">
    <nav class="container">
        <!-- Logo -->
        <a href="index.php?page=<?= $home; ?>" class="logo-link">
            <div class="logo">
                <img src="assets/images/WorknGo_logo.svg" alt="Logo" class="logo-icon">
                <span>WorknGo</span>
            </div>
        </a>

        <!-- Liens de navigation -->
        <div class="nav-links">
            <a href="index.php?page=<?= encryptPage("pages/home"); ?>" class="nav-link">Accueil</a>
            <a href="index.php?page=<?= encryptPage("offres/liste"); ?>" class="nav-link">Offres</a>
            <a href="index.php?page=<?= encryptPage("entreprises/liste"); ?>" class="nav-link">Entreprises</a>
            <a href="index.php?page=<?= encryptPage("pages/contact"); ?>" class="nav-link">Contact</a>
        </div>

        <!-- Boutons d'authentification -->
        <div class="auth-buttons">
            <button onclick="window.location.href='index.php?page=<?= encryptPage('auth/connexion'); ?>'" class="btn btn-text">Se connecter</button>
            <button onclick="window.location.href='index.php?page=<?= encryptPage('auth/inscription'); ?>'" class="btn btn-primary">Créer un compte</button>
        </div>

        <!-- Bouton pour le menu mobile -->
        <button class="mobile-menu-btn" aria-label="Menu">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <!-- Menu Mobile -->
        <div class="mobile-menu">
            <a href="index.php?page=<?= encryptPage("pages/home"); ?>" class="nav-link">Accueil</a>
            <a href="index.php?page=<?= encryptPage("offres/liste"); ?>" class="nav-link">Offres</a>
            <a href="index.php?page=<?= encryptPage("entreprises/liste"); ?>" class="nav-link">Entreprises</a>
            <a href="index.php?page=<?= encryptPage("pages/contact"); ?>" class="nav-link">Contact</a>

            <button onclick="window.location.href='index.php?page=<?= encryptPage('auth/connexion'); ?>'" class="btn btn-text">Se connecter</button>
            <button onclick="window.location.href='index.php?page=<?= encryptPage('auth/inscription'); ?>'" class="btn btn-primary">Créer un compte</button>
        </div>
    </nav>
</header>
