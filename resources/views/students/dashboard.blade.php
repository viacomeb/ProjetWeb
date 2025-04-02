@extends('students.app')

@section('title', ucfirst($page))

@section('content')
<div class="dashboard-content">
    <!-- Overview Section -->
    <section id="overview" class="section-content active">
        <div class="welcome-banner">
            <div class="streak-info">
                <i class="fas fa-fire"></i>
                <span>5 jours de streak! 🔥</span>
            </div>
            <h2>Bonjour John, prêt pour une nouvelle journée?</h2>
            <p>Continue sur ta lancée! Tu es sur la bonne voie.</p>
        </div>

        <div class="progress-cards">
            <div class="progress-card">
                <div class="progress-header">
                    <h3>Progression des candidatures</h3>
                    <span class="total-count">15 total</span>
                </div>
                <div class="progress-bars">
                    <div class="progress-item">
                        <div class="progress-label">
                            <span>En attente</span>
                            <span>5</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress" style="width: 33%"></div>
                        </div>
                    </div>
                    <div class="progress-item">
                        <div class="progress-label">
                            <span>En cours</span>
                            <span>8</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress" style="width: 53%"></div>
                        </div>
                    </div>
                    <div class="progress-item">
                        <div class="progress-label">
                            <span>Refusées</span>
                            <span>2</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress" style="width: 13%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="progress-card">
                <div class="progress-header">
                    <h3>Objectifs du jour</h3>
                    <span class="completion-rate">2/3 complétés</span>
                </div>
                <div class="daily-goals">
                    <div class="goal-item completed">
                        <i class="fas fa-check-circle"></i>
                        <span>Postuler à 3 offres</span>
                        <div class="xp-reward">+50 XP</div>
                    </div>
                    <div class="goal-item completed">
                        <i class="fas fa-check-circle"></i>
                        <span>Mettre à jour ton CV</span>
                        <div class="xp-reward">+30 XP</div>
                    </div>
                    <div class="goal-item">
                        <i class="fas fa-circle"></i>
                        <span>Participer au forum</span>
                        <div class="xp-reward">+20 XP</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recommended Offers Section -->
        <div class="offers-section">
            <div class="section-header">
                <h2>Offres recommandées</h2>
                <div class="filters">
                    <button class="filter-btn active">Tous</button>
                    <button class="filter-btn">Tech</button>
                    <button class="filter-btn">Design</button>
                    <button class="filter-btn">Marketing</button>
                </div>
            </div>
            <div class="offers-grid">
                <div class="offer-card">
                    <div class="offer-match">
                        <span>95% match</span>
                    </div>
                    <div class="offer-header">
                        <img
                            src="https://ui-avatars.com/api/?name=Tech+Corp"
                            alt="Company" />
                        <div class="offer-company">
                            <h3>Développeur Full-Stack</h3>
                            <p>TechCorp</p>
                        </div>
                    </div>
                    <div class="offer-details">
                        <div class="offer-tags">
                            <span class="tag">React</span>
                            <span class="tag">Node.js</span>
                            <span class="tag">6 mois</span>
                        </div>
                        <p class="offer-location">
                            <i class="fas fa-map-marker-alt"></i>
                            Paris (Hybride)
                        </p>
                        <p class="offer-salary">
                            <i class="fas fa-euro-sign"></i>
                            1000€ - 1200€
                        </p>
                    </div>
                    <div class="offer-actions">
                        <button class="btn-primary">
                            <i class="fas fa-paper-plane"></i>
                            Postuler en 1 clic
                        </button>
                        <button class="btn-secondary">
                            <i class="fas fa-bookmark"></i>
                        </button>
                    </div>
                </div>
                <div class="offer-card">
                    <div class="offer-match">
                        <span>88% match</span>
                    </div>
                    <div class="offer-header">
                        <img
                            src="https://ui-avatars.com/api/?name=Data+Insight"
                            alt="Company" />
                        <div class="offer-company">
                            <h3>Data Analyst</h3>
                            <p>DataInsight</p>
                        </div>
                    </div>
                    <div class="offer-details">
                        <div class="offer-tags">
                            <span class="tag">Python</span>
                            <span class="tag">SQL</span>
                            <span class="tag">4 mois</span>
                        </div>
                        <p class="offer-location">
                            <i class="fas fa-map-marker-alt"></i>
                            Lyon (Remote)
                        </p>
                        <p class="offer-salary">
                            <i class="fas fa-euro-sign"></i>
                            800€ - 1000€
                        </p>
                    </div>
                    <div class="offer-actions">
                        <button class="btn-primary" id="submitApplication">
                            <i class="fas fa-paper-plane"></i>
                            Postuler
                        </button>
                        <button class="btn-secondary">
                            <i class="fas fa-bookmark"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="battle-pass">
            <div class="battle-pass-header">
                <h2>Battle Pass - Saison 1</h2>
                <div class="battle-pass-progress">
                    <div class="progress-bar">
                        <div class="progress" style="width: 65%"></div>
                    </div>
                    <span>Niveau 5 - 650/1000 XP</span>
                </div>
            </div>

            <div class="rewards-track">
                <div class="reward-item unlocked">
                    <div class="reward-icon">
                        <i class="fas fa-medal"></i>
                    </div>
                    <div class="reward-info">
                        <h4>Badge "Chercheur Débutant"</h4>
                        <p>Débloqué au niveau 1</p>
                    </div>
                </div>

                <div class="reward-item unlocked">
                    <div class="reward-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="reward-info">
                        <h4>Voir qui visite ton profil</h4>
                        <p>Débloqué au niveau 3</p>
                    </div>
                </div>

                <div class="reward-item current">
                    <div class="reward-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="reward-info">
                        <h4>Profil mis en avant</h4>
                        <p>Débloquer au niveau 7</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Challenges Section -->
        <div id="challenges" class="section-content">
            <div class="battle-pass">
                <div class="battle-pass-header">
                    <h2>Battle Pass - Saison 1</h2>
                    <div class="battle-pass-progress">
                        <div class="progress-bar">
                            <div class="progress" style="width: 65%"></div>
                        </div>
                        <span>Niveau 5 - 650/1000 XP</span>
                    </div>
                </div>

                <div class="rewards-track">
                    <div class="reward-item unlocked">
                        <div class="reward-icon">
                            <i class="fas fa-medal"></i>
                        </div>
                        <div class="reward-info">
                            <h4>Badge "Chercheur Débutant"</h4>
                            <p>Débloqué au niveau 1</p>
                        </div>
                    </div>

                    <div class="reward-item unlocked">
                        <div class="reward-icon">
                            <i class="fas fa-eye"></i>
                        </div>
                        <div class="reward-info">
                            <h4>Voir qui visite ton profil</h4>
                            <p>Débloqué au niveau 3</p>
                        </div>
                    </div>

                    <div class="reward-item current">
                        <div class="reward-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="reward-info">
                            <h4>Profil mis en avant</h4>
                            <p>Débloquer au niveau 7</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Community Section -->
        <div class="community-section">
            <div class="community-header">
                <h2>Espace communauté</h2>
                <button class="btn-primary">
                    <i class="fas fa-plus"></i>
                    Nouvelle discussion
                </button>
            </div>
            <div class="community-content">
                <div class="forum-posts">
                    <div class="forum-post">
                        <div class="post-author">
                            <img
                                src="https://ui-avatars.com/api/?name=Lucas+Dubois"
                                alt="Author" />
                            <div class="author-info">
                                <h4>Lucas Dubois</h4>
                                <span>Il y a 2h</span>
                            </div>
                        </div>
                        <div class="post-content">
                            <h3>Conseils pour un entretien tech ?</h3>
                            <p>
                                Je passe un entretien chez TechCorp la semaine
                                prochaine, des conseils ?
                            </p>
                            <div class="post-stats">
                                <span><i class="fas fa-comment"></i> 12 réponses</span>
                                <span><i class="fas fa-heart"></i> 5 likes</span>
                            </div>
                        </div>
                    </div>
                    <div class="forum-post">
                        <div class="post-author">
                            <img
                                src="https://ui-avatars.com/api/?name=Emma+Bernard"
                                alt="Author" />
                            <div class="author-info">
                                <h4>Emma Bernard</h4>
                                <span>Il y a 4h</span>
                            </div>
                        </div>
                        <div class="post-content">
                            <h3>Retour d'expérience : Stage Data Science</h3>
                            <p>
                                Je viens de terminer mon stage chez DataInsight, je
                                partage mon expérience !
                            </p>
                            <div class="post-stats">
                                <span><i class="fas fa-comment"></i> 8 réponses</span>
                                <span><i class="fas fa-heart"></i> 15 likes</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mentors-section">
                    <h3>Mentors disponibles</h3>
                    <div class="mentors-list">
                        <div class="mentor-card">
                            <img
                                src="https://ui-avatars.com/api/?name=Sophie+Martin"
                                alt="Mentor" />
                            <div class="mentor-info">
                                <h4>Sophie Martin</h4>
                                <p>Lead Dev chez TechCorp</p>
                                <div class="mentor-stats">
                                    <span><i class="fas fa-star"></i> 4.9/5</span>
                                    <span><i class="fas fa-user"></i> 12 mentorés</span>
                                </div>
                            </div>
                            <button class="btn-primary">Contacter</button>
                        </div>
                        <div class="mentor-card">
                            <img
                                src="https://ui-avatars.com/api/?name=Marc+Dubois"
                                alt="Mentor" />
                            <div class="mentor-info">
                                <h4>Marc Dubois</h4>
                                <p>Data Scientist chez DataInsight</p>
                                <div class="mentor-stats">
                                    <span><i class="fas fa-star"></i> 4.7/5</span>
                                    <span><i class="fas fa-user"></i> 8 mentorés</span>
                                </div>
                            </div>
                            <button class="btn-primary">Contacter</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Leaderboard Section -->
        <div class="leaderboard-section">
            <h2>Top Candidats</h2>
            <div class="leaderboard">
                <div class="leaderboard-item top">
                    <div class="rank">1</div>
                    <img
                        src="https://ui-avatars.com/api/?name=Thomas+Laurent"
                        alt="User" />
                    <div class="user-info">
                        <h4>Thomas Laurent</h4>
                        <p>2500 XP</p>
                    </div>
                    <div class="badges">
                        <i class="fas fa-medal" style="color: gold"></i>
                        <i class="fas fa-trophy" style="color: gold"></i>
                    </div>
                </div>
                <div class="leaderboard-item">
                    <div class="rank">2</div>
                    <img
                        src="https://ui-avatars.com/api/?name=Marie+Martin"
                        alt="User" />
                    <div class="user-info">
                        <h4>Marie Martin</h4>
                        <p>2250 XP</p>
                    </div>
                    <div class="badges">
                        <i class="fas fa-medal" style="color: silver"></i>
                    </div>
                </div>
                <div class="leaderboard-item">
                    <div class="rank">3</div>
                    <img
                        src="https://ui-avatars.com/api/?name=Lucas+Dubois"
                        alt="User" />
                    <div class="user-info">
                        <h4>Lucas Dubois</h4>
                        <p>2100 XP</p>
                    </div>
                    <div class="badges">
                        <i class="fas fa-medal" style="color: #cd7f32"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
