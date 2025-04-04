@extends('students.app')

@section('title', ucfirst($page))

@section('content')
    <!-- Dashboard Content -->
    <div class="dashboard-content">
        <!-- Challenges Section -->
        <section id="challenge" class="section-content active">
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
        </section>
    </div>

@endsection
