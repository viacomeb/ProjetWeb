<?php
// src/View/Home/index.php

// Définir le titre de la page pour l'affichage dynamique dans le header
$pageTitle = "StageFlow - Trouvez votre stage comme jamais auparavant";
?>

<!-- HERO SECTION -->
<section class="hero">
    <div class="container">
        <h1>Trouvez votre stage comme jamais auparavant</h1>
        <p>Une plateforme innovante qui révolutionne la recherche de stages grâce à l'IA</p>
        <div class="hero-buttons">
            <button class="btn btn-primary">
                Je suis étudiant
                <!-- Icône fléchée dans le bouton -->
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m9 18 6-6-6-6" />
                </svg>
            </button>
            <button class="btn btn-outline">
                Je suis une entreprise
            </button>
        </div>
    </div>
</section>

<!-- FEATURES SECTION -->
<section class="features">
    <div class="container">
        <h2>Fonctionnalités principales</h2>
        <div class="features-grid">
            <!-- FEATURE CARD 1: IA Matching -->
            <div class="feature-card">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313-12.454z" />
                    <path d="M17 4a2 2 0 0 0 2 2a2 2 0 0 0-2 2a2 2 0 0 0-2-2a2 2 0 0 0 2-2" />
                    <path d="M19 11h2" />
                    <path d="M19 15h2" />
                </svg>
                <h3>IA Matching</h3>
                <p>Trouvez les stages parfaits grâce à notre algorithme de matching intelligent</p>
            </div>
            <!-- FEATURE CARD 2: Suivi en temps réel -->
            <div class="feature-card">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10" />
                    <polyline points="12 6 12 12 16 14" />
                </svg>
                <h3>Suivi en temps réel</h3>
                <p>Suivez vos candidatures et leur progression en temps réel</p>
            </div>
            <!-- FEATURE CARD 3: Communication fluide -->
            <div class="feature-card">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                    <path d="M14 8.5a2.5 2.5 0 0 0-5 0v1a2.5 2.5 0 0 0 5 0z" />
                </svg>
                <h3>Communication fluide</h3>
                <p>Échangez facilement avec les recruteurs via notre plateforme</p>
            </div>
            <!-- FEATURE CARD 4: Communauté active -->
            <div class="feature-card">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                    <circle cx="9" cy="7" r="4" />
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                </svg>
                <h3>Communauté active</h3>
                <p>Rejoignez une communauté d'étudiants et professionnels</p>
            </div>
        </div>
    </div>
</section>

<!-- STATS SECTION -->
<section class="stats">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">500+</div>
                <div class="stat-label">Stages trouvés</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">1000+</div>
                <div class="stat-label">Étudiants actifs</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">200+</div>
                <div class="stat-label">Entreprises partenaires</div>
            </div>
        </div>
    </div>
</section>

<!-- TESTIMONIALS SECTION -->
<section class="testimonials">
    <div class="container">
        <h2>Ce qu'ils en pensent</h2>
        <div class="testimonials-grid">
            <!-- Testimonial 1 -->
            <div class="testimonial-card">
                <div class="testimonial-header">
                    <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-4.0.3" alt="Sophie Martin">
                    <div>
                        <h3>Sophie Martin</h3>
                        <p>Étudiante en Marketing Digital</p>
                    </div>
                </div>
                <div class="testimonial-content">
                    <svg class="quote-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 21c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2H4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1 0 1 1v1c0 1-1 2-2 2s-1 .008-1 1.031V20c0 1 0 1 1 1z" />
                        <path d="M15 21c3 0 7-1 7-8V5c0-1.25-.757-2.017-2-2h-4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2h.75c0 2.25.25 4-2.75 4v3c0 1 0 1 1 1z" />
                    </svg>
                    <p>WorknGo a complètement changé ma recherche de stage ! L'IA m'a trouvé le stage parfait en quelques jours seulement.</p>
                </div>
                <div class="testimonial-rating">
                    ★★★★★
                </div>
            </div>
            <!-- Testimonial 2 -->
            <div class="testimonial-card">
                <div class="testimonial-header">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3" alt="Thomas Dubois">
                    <div>
                        <h3>Thomas Dubois</h3>
                        <p>Étudiant en Informatique</p>
                    </div>
                </div>
                <div class="testimonial-content">
                    <svg class="quote-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 21c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2H4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1 0 1 1v1c0 1-1 2-2 2s-1 .008-1 1.031V20c0 1 0 1 1 1z" />
                        <path d="M15 21c3 0 7-1 7-8V5c0-1.25-.757-2.017-2-2h-4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2h.75c0 2.25.25 4-2.75 4v3c0 1 0 1 1 1z" />
                    </svg>
                    <p>Une plateforme incroyable qui m'a permis de trouver un stage dans une startup innovante. Le matching par IA est vraiment efficace !</p>
                </div>
                <div class="testimonial-rating">
                    ★★★★★
                </div>
            </div>
            <!-- Testimonial 3 -->
            <div class="testimonial-card">
                <div class="testimonial-header">
                    <img src="https://media.licdn.com/dms/image/v2/D4D03AQFILDusl0KreA/profile-displayphoto-shrink_800_800/profile-displayphoto-shrink_800_800/0/1728811932003?e=1746662400&v=beta&t=Zhf4udqCaqp_R6GPRCwmD7qMtvULpebvIIa6feF_7eM" alt="Antoine Roure">
                    <div>
                        <h3>Antoine Roure</h3>
                        <p>Gros neuille</p>
                    </div>
                </div>
                <div class="testimonial-content">
                    <svg class="quote-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 21c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2H4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1 0 1 1v1c0 1-1 2-2 2s-1 .008-1 1.031V20c0 1 0 1 1 1z" />
                        <path d="M15 21c3 0 7-1 7-8V5c0-1.25-.757-2.017-2-2h-4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2h.75c0 2.25.25 4-2.75 4v3c0 1 0 1 1 1z" />
                    </svg>
                    <p>Je recommande WorknGo à tous mes amis. C'est de loin la meilleure plateforme pour trouver un stage qui correspond vraiment à nos attentes.</p>
                </div>
                <div class="testimonial-rating">
                    ★★★★★
                </div>
            </div>
        </div>
    </div>
</section>

<!-- BOUTON DU CHATBOT -->
<button class="chatbot-button">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M12 2a7 7 0 0 1 7 7v4a7 7 0 0 1-7 7v3h-2v-3a7 7 0 0 1-7-7V9a7 7 0 0 1 7-7z" />
        <line x1="9" y1="9" x2="9" y2="9.01" />
        <line x1="15" y1="9" x2="15" y2="9.01" />
        <path d="M8 14h8" />
    </svg>
</button>
