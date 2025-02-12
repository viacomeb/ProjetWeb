<?php
// src/View/layout/header.php
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Affichage dynamique du titre si défini, sinon "StageFlow" par défaut -->
    <title><?= isset($pageTitle) ? $pageTitle : "StageFlow" ?></title>
    <!-- Lien vers le fichier CSS global -->
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
    <!-- HEADER -->
    <header class="header">
        <nav class="container">
            <!-- Logo -->
            <div class="logo">
                <!-- Exemple de logo en SVG -->
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="logo-icon">
                    <path d="M2 22c1.25-.987 2.27-1.975 3.9-2.2a5.56 5.56 0 0 1 3.8.9 4 4 0 0 0 4.6 0 5.56 5.56 0 0 1 3.8-.9c1.63.225 2.65 1.213 3.9 2.2" />
                    <!-- Vous pouvez ajouter d'autres chemins si besoin -->
                </svg>
                <span>StageFlow</span>
            </div>

            <!-- Liens de navigation -->
            <div class="nav-links">
                <a href="/" class="nav-link">Accueil</a>
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
